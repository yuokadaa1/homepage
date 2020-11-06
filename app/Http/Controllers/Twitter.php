<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Log;

class Twitter extends Controller
{

  public function index()
  {
    return view('twitter.index');
  }

  public function search(Request $request)
  {
    // 変数の初期設定
    $nextToken = "a";
    $tweet_count = 0;
    $roop_count = 0;
    $arrayDataS = array();
    $arrayDataM = array();
    $gasSetText = array();

    // URLで検索した場合、構成されているURLからtweetID,tweetUserに分解
    if( isset($request->button3) ){
      $address1 = parse_url($request->searchURL);
      $address2 = explode("/",$address1['path']);
      $request->tweetId = $address2[3];
      $request->userName = $address2[1];
    }

    while (!empty($nextToken) and $tweet_count < 2000 and $roop_count < 20):

      $parts_name = array();
      $parts_id = array();

      $responseJsonText = $this->curlCoal("search",$request,$nextToken);

      // nextTokenがあったら再検索するため、urlにnextTokenを設定する。
      if (!empty($responseJsonText->meta->next_token)){
        $nextToken = $responseJsonText->meta->next_token;
        // $url = $url . "&next_token=" . $nextToken;
      }else{
        $nextToken = "";
      }

      // エラーがあった場合はddして処理中断。
      if( empty($responseJsonText->errors) ){} else {dd("エラーが出現しました。" . $tweets);}
      // 1週間以内にtweetがないとstatusesが0になるので0が返ってきたときは繰り返しを終了させる。
      if( count($responseJsonText->data) == 0 ){$tweet_count == 99999;}
      // ユーザー情報(includes)の取得失敗時も終了にする。
      if(empty($responseJsonText->includes)){dd("includesの取得に失敗しました。",$curl,$responseJsonText);}

      // user_fieldsは重複した場合1つしか帰らない(1idで2tweet取れた場合、dataは2,usersは1)ので検索する。
      // curlの返信結果が{data:[],includes:{users:[],media[]},meta;{}}になっているので検索用に並列化
      foreach ($responseJsonText->includes->users as $user){
        array_push($parts_name , $user->username);
        array_push($parts_id , $user->id);
      }
      foreach ($responseJsonText->data as $data){
        $data->username = $parts_name[array_search($data->author_id,$parts_id)];
      }

      // 取ってきたreturn件数を繰り返し判定に加算
      $tweet_count += $responseJsonText->meta->result_count;

      // データの退避
      $roop_count++;
      $arrayDataS = array_merge($arrayDataS,$responseJsonText->data );
      $arrayDataM[] = (array)$responseJsonText->meta;

    endwhile;

    $responseJsonText = $this->curlCoal("ids",$request,$nextToken);
    $responseJsonText->data[0]->username = $responseJsonText->includes->users[0]->username;
    $arrayDataS = array_merge($arrayDataS,$responseJsonText->data );

    // 取得したデータを逆順でobjectにセット（最新順に取得されてしまうため。）
    $tweets = (object)(["statuses" => array_reverse($arrayDataS),"search_metadata" => array_reverse($arrayDataM)]);

    if( empty($request->{'searchWord'}) ){
      foreach ($tweets->statuses as $tweet){
        $tweet->created_at = date("Y-m-d h:i:s",strtotime($tweet->created_at));
        array_push( $gasSetText , $tweet->text );
      }
    }

    // oogle翻訳もかけておく
    // curlコマンドで実行するとき。
    // curl -d '{"text":"hello", "source":"en","target":"ja"}' -L https://script.google.com/macros/s/AKfycbySxRYYZ_23oXT1gn-4d2mkXhk6f9gj6ywynCKmAASiojvvroZf/exec
    $params = array('text' => $gasSetText,'source' => "en",'target' => "ja");
    $sendURL = "https://script.google.com/macros/s/AKfycbySxRYYZ_23oXT1gn-4d2mkXhk6f9gj6ywynCKmAASiojvvroZf/exec";

    $curl = curl_init($sendURL);      // curlの処理を始める合図
    curl_setopt($curl, CURLOPT_POST, true); //POST送信
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params)); //postするデータの格納（json）
    curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);//Locationをたどる
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);//文字列で結果を返させる
    $response = curl_exec($curl);// レスポンスを変数に入れる
    curl_close($curl);// curlの処理を終了

    $returnAPI = json_decode( $response );
    // GASにから返ってきた情報を配列にセット
    foreach ($tweets->statuses as $idx => $tweet){
      $tweet->textJp = $returnAPI->message[$idx];
    }

    return view('twitter.index')->
          with(['getTweets' => $tweets , 'inputURL' => $request->searchURL ,
                'tweet_count' => $tweet_count , 'tweet_count_all' => count($tweets->statuses)]);
  }

  public function curlCoal($pattern,$request,$nextToken){
    $KEY = 'AAAAAAAAAAAAAAAAAAAAACwgHwEAAAAAtDtHjGC9fhSdqbYdcPQIOTb%2Fd%2F0%3DgfB2IdydyYfyw9Ao1YXLZ440FWyS491QzYNc02zs5OyTeMwyjb';

    $base = "https://api.twitter.com/2/tweets";
    if($pattern == "search" ){
      $param = "/search/recent?query=conversation_id:" . $request->tweetId;
      $param = $param . "&max_results=100";
    }else{
      $param = "?ids=" . $request->tweetId;
    }

    $param = $param . "&expansions=author_id,attachments.media_keys";
    $param = $param . "&media.fields=preview_image_url,type";
    $param = $param . "&place.fields=country,country_code";
    $param = $param . "&tweet.fields=created_at,lang,conversation_id";
    $param = $param . "&user.fields=id,username";
    $headers = array(
      "Content-Type:application/x-www-form-urlencoded,application/json",
      "Authorization: Bearer " . $KEY
    );

    $url = $base . $param;
    if ( !empty($nextToken) and $nextToken <> "a" ){
      $url = $url . "&next_token=" . $nextToken;
    }

    // curlを実行し得てtwitterAPIを呼び出し
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $returnText = json_decode(curl_exec($curl));
    curl_close($curl);// curlの処理を終了

    return $returnText;
  }

}
