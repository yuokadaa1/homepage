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
    $tweets = array();
    $gasSetText = array();

    // URLで検索した場合、構成されているURLからtweetID,tweetUserに分解
    if( isset($request->button3) ){
      $address1 = parse_url($request->searchURL);
      $address2 = explode("/",$address1['path']);
      $request->tweetId = $address2[3];
      $request->userName = $address2[1];
    }

    // conversation元,conversation,reTweetのツイートを順番に取得
    $originTweet = $this->getTweet("original",$request);
    $conversation = $this->getTweet("conversation",$request);
    $reTweet = $this->getTweet("reTweet",$request);

    // 取得したデータを逆順でobjectにセット（最新順に取得されてしまうため。）
    // if( !empty($reTweet) ){$tweets = array_merge($tweets,array_reverse($reTweet->statuses));}
    // if( !empty($conversation) ){$tweets = array_merge($tweets,array_reverse($conversation->statuses));}
    // if( !empty($originTweet) ){$tweets = array_merge($tweets,array_reverse($originTweet->statuses));}
    if( !empty($originTweet) ){$tweets = array_merge($tweets,$originTweet->statuses);}
    if( !empty($conversation) ){$tweets = array_merge($tweets,$conversation->statuses);}
    if( !empty($reTweet) ){$tweets = array_merge($tweets,$reTweet->statuses);}
    $tweets = (object)(["statuses" => $tweets]);

    if( !empty($tweets->statuses) ){
      foreach ( $tweets->statuses as $tweet ){
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
                'tweet_count' => 0 , 'tweet_count_all' => 0]);
                // 'tweet_count' => $tweet_count , 'tweet_count_all' => count($tweets->statuses)]);
  }

  public function getTweet($searchType,$request){

    $nextToken = "a";
    $tweet_count = 0;
    $roop_count = 0;
    $arrayDataS = array();
    $arrayDataM = array();

    while (!empty($nextToken) and $tweet_count < 1000 and $roop_count < 20):

      $parts_name = array();
      $parts_id = array();

      $responseJsonText = $this->curlCoal($searchType,$request,$nextToken);

      // nextTokenがあったら再検索するため、urlにnextTokenを設定する。
      if (!empty($responseJsonText->meta->next_token)){
        $nextToken = $responseJsonText->meta->next_token;
      }else{
        $nextToken = "";
      }

      // エラーがあった場合はddして処理中断。
      if( empty($responseJsonText->errors) ){
      } else {
        if($responseJsonText->errors[0]->title == "Not Found Error"){
          // リツイート元のツイートが削除されている場合のエラーは読み飛ばす
          // （referenced_tweets->idに入っているツイートが削除済み）
          // https://linvi.github.io/tweetinvi/dist/twitter-api-v2/basics.html#errors
        } else {
          dd("searchType:" . $searchType,"エラーが出現しました。" , $responseJsonText);
        }
      }

      // データがとれなければブレイク
      if( empty($responseJsonText->data) or count($responseJsonText->data) == 0 ){break;}
      if( empty($responseJsonText->includes) ){dd("includes(ユーザー情報)の取得に失敗しました。",$curl,$responseJsonText);}
      if( empty($responseJsonText->meta) and $searchType <> "original" ){dd("meta取得失敗",$searchType,$responseJsonText);}

      // user_fieldsは重複した場合1つしか帰らない(1idで2tweet取れた場合、dataは2,usersは1)ので検索する。
      // curlの返信結果が{data:[],includes:{users:[],media[]},meta;{}}になっているので検索用に並列化
      foreach ($responseJsonText->includes->users as $user){
        array_push($parts_name , $user->username);
        array_push($parts_id , $user->id);
      }
      // $count = 0;
      // $count2 = 0;
      // $count3 = 0;
      foreach ($responseJsonText->data as $key => $data){
        if( $searchType == "reTweet" ){
          // if( !empty($data->referenced_tweets[0]->id) ){
          //   $count2++;
          //   if( $data->conversation_id != $request->tweetId ){
          //     $count3++;
          //     if( $data->referenced_tweets[0]->id == $request->tweetId ){
          //       $count++;
          //     }
          //   }
          }
        }
        // reTweetはuserNameで検索かけているので不要なものがたらふく取れているので排除しておく
        if( $searchType == "reTweet" and ( empty($data->referenced_tweets[0]->id) or
        $data->conversation_id == $request->tweetId or $data->referenced_tweets[0]->id <> $request->tweetId )){
          // unset($responseJsonText->data[$key]);
        }else{
          $data->username = $parts_name[array_search($data->author_id,$parts_id)];
          $data->serachType = $searchType;
        }
      }
      // if( $searchType == "reTweet"){
      //   dd($count,$count2,$count3,$request->tweetId,$responseJsonText);
      // }
      // 件数の加算とデータの退避
      $roop_count++;
      $arrayDataS = array_merge($arrayDataS,$responseJsonText->data );
      // originalの場合はmeta情報がセットされないので除外
      if( $searchType <> "original" ){
        $arrayDataM[] = (array)$responseJsonText->meta;
        $tweet_count += $responseJsonText->meta->result_count;
      }

    endwhile;

    $return = (object)(["statuses" => array_reverse($arrayDataS),"search_metadata" => array_reverse($arrayDataM)]);

    return $return;
  }

  public function curlCoal($searchType,$request,$nextToken){

    $KEY = 'AAAAAAAAAAAAAAAAAAAAACwgHwEAAAAAtDtHjGC9fhSdqbYdcPQIOTb%2Fd%2F0%3DgfB2IdydyYfyw9Ao1YXLZ440FWyS491QzYNc02zs5OyTeMwyjb';

    $base = "https://api.twitter.com/2/tweets";
    if($searchType == "conversation" ){
      $param = "/search/recent?query=conversation_id:" . $request->tweetId;
      // $param = $param . "&max_results=100";
    }elseif($searchType == "reTweet"){
      // reTweetはv2だと検索機能がまだ機能していないのでv1.1でっとってくる。
      $base = 'https://api.twitter.com/1.1/statuses/retweets/';
      $param = $request->tweetId . '.json';
      // v2でuser名から無理やり取ってこようとしたときのパラメータ
      // $param = "/search/recent?query=" . $request->userName;
      $param = $param . "?count=100";
    }else{
      // if($searchType == "original")
      $param = "?ids=" . $request->tweetId;
    }
    // reTweetはv1.1で取ってくるのでこのへんが設定できない
    if($searchType <> "reTweet"){
      $param = $param . "&expansions=author_id,attachments.media_keys,referenced_tweets.id";
      $param = $param . "&media.fields=preview_image_url,type";
      $param = $param . "&place.fields=country,country_code";
      $param = $param . "&tweet.fields=created_at,lang,conversation_id";
      $param = $param . "&user.fields=id,username";
    }
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

    // if($searchType == "reTweet"){
    //   dd($returnText);
    // }

    return $returnText;
  }

}
