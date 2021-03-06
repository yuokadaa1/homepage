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
    //Originの件数(全て1)
    $countO = 0;
    //conversationの件数
    $countC = 0;
    //reTweetの件数
    $countR = 0;
    //wordでsearchした件数
    $countS = 0;

    // URLで検索した場合、構成されているURLからtweetID,tweetUserに分解
    if( isset($request->button3) ){

      $address1 = parse_url($request->searchURL);
      $address2 = explode("/",$address1['path']);
      $request->tweetId = $address2[3];
      $request->userName = $address2[1];

      // conversation元,conversation,reTweetのツイートを順番に取得
      $originTweet = $this->getTweet("original",$request);
      $conversation = $this->getTweet("conversation",$request);
      $reTweet = $this->getTweet("reTweet",$request);

    }elseif(isset($request->button4)){
      // wordで検索した場合はconversationやretweetを探さない
      $searchWord = $this->getTweet("searchWord",$request);
    }

    if( !empty($originTweet) ){
      $tweets = array_merge($tweets,$originTweet->statuses);
      $countO = $originTweet->count;
    }
    if( !empty($conversation) ){
      $tweets = array_merge($tweets,$conversation->statuses);
      $countC = $conversation->count;
    }
    if( !empty($reTweet) ){
      $tweets = array_merge($tweets,$reTweet->statuses);
      $countR = $reTweet->count;
    }
    if( !empty($searchWord)){
      // 検索については日時でDESCSortする。項目を日付に指定するためいったんcollectionに変換⇒sortして配列に戻す
      $tweets = collect(array_merge($tweets,$searchWord->statuses));
      $tweets = $tweets->sortByDesc('created_at')->values()->toArray();
      $countS = count($tweets);
    }

    $tweets = (object)(["statuses" => $tweets , "countO" =>$countO,"countC" => $countC,"countR" =>$countR,"countS" =>$countS]);

    // 1件も取れていない場合（originalがとれていない＝アドレスエラーだが）は以降の処理をしない
    if( !empty($tweets->statuses) ){
      foreach ( $tweets->statuses as $tweet ){
        $tweet->created_at = date("Y-m-d h:i:s",strtotime($tweet->created_at));
        array_push( $gasSetText , $tweet->text );
      }
      // GASを呼び出して翻訳、objectに結果をセットする。
      $returnAPI = $this->curlCoalGAS($gasSetText);
      if( !empty($returnAPI->message) ){
        foreach ($tweets->statuses as $idx => $tweet){
          $tweet->textJp = $returnAPI->message[$idx];
        }
      }else{
        foreach ($tweets->statuses as $idx => $tweet){
            $tweet->textJp = "";
        }
      }
    }

    return view('twitter.index')->
          with(['getTweets' => $tweets , 'inputURL' => $request->searchURL , 'inputWord' => $request->searchWord,
                'tweet_count' => 0 , 'tweet_count_all' => 0]);
                // 'tweet_count' => $tweet_count , 'tweet_count_all' => count($tweets->statuses)]);
  }

  public function getTweet($searchType,$request){

    $nextToken = "a";
    $tweet_count = 0;
    $roop_count = 0;
    $arrayDataS = array();
    $arrayDataM = array();

    // nextTokenが存在するか、取得したtweet件数が300未満か、roop回数が5回未満の間は取得を繰り返す。
    // searchWordかけた時しかnumRotationは設定されないのでsearchURLの時は適当に3周りを設定。
    if(!isset($request->numRotation)){
      $request->numRotation = 3;
    }

    while( !empty($nextToken) and $roop_count < $request->numRotation ):

      $parts_name = array();
      $parts_id = array();

      $responseJsonText = $this->curlCoal($searchType,$request,$nextToken);

      // nextTokenがあったら再検索するため、urlにnextTokenを設定する。
      if( !empty($responseJsonText->meta->next_token) ){
        $nextToken = $responseJsonText->meta->next_token;
      }else{
        $nextToken = "";
      }

      // エラーがあった場合はddして処理中断。
      if( empty($responseJsonText->errors) ){
      } else {
        if(isset($responseJsonText->errors[0]->title)){
          if($responseJsonText->errors[0]->title == "Not Found Error"){
            // リツイート元のツイートが削除されている場合のエラーは読み飛ばす
            // （referenced_tweets->idに入っているツイートが削除済み）
            // https://linvi.github.io/tweetinvi/dist/twitter-api-v2/basics.html#errors
          } elseif($responseJsonText->errors[0]->title == "Authorization Error") {
            // "Sorry, you are not authorized to see the Tweet with referenced_tweets.id: [1403269474036314113]."
            // 何かのAuthorizedエラー。スルーする。
          }else{
            dd("searchType:" . $searchType,"エラーが出現しました。" , $responseJsonText);
          }
        }else{
          dd("searchType:" . $searchType,"エラーが出現しました。" , $responseJsonText);
        }
      }

      // データがとれなければブレイク
      if( $searchType == "reTweet" ){
        if( empty($responseJsonText) or count($responseJsonText) == 0 ){break;}
      }elseif($searchType == "original" or $searchType == "conversation" or $searchType == "searchWord"){
        if( empty($responseJsonText->data) or count($responseJsonText->data) == 0 ){break;}
        if( empty($responseJsonText->includes) ){dd("includes(ユーザー情報)の取得に失敗しました。",$curl,$responseJsonText);}
        if( empty($responseJsonText->meta) and $searchType <> "original" ){dd("meta取得失敗",$searchType,$responseJsonText);}
      }

      // dd($responseJsonText);
      // searchWordの場合は反響があるものだけを抽出する。
      if($searchType == "searchWord" and $request->displayBorder > 0){
        foreach ($responseJsonText->data as $key => $data){
          if($data->public_metrics->retweet_count < $request->displayBorder and
             $data->public_metrics->reply_count   < $request->displayBorder and
             $data->public_metrics->like_count    < $request->displayBorder){
            unset($responseJsonText->data[$key]);
          }
        }
      }

      if( $searchType == "reTweet" ){
        foreach ($responseJsonText as $key => $data){
          if($data->is_quote_status == true){
            $returnParts = array();
            $returnParts['id'] = $data->id;
            $returnParts['created_at'] = $data->created_at;
            $returnParts['text'] = $data->text;
            $returnParts['username'] = $data->user->screen_name;
            $returnParts['searchType'] = $searchType;
            $arrayDataS = array_merge($arrayDataS,array((object)$returnParts));
          }
        }
      }elseif($searchType == "original" or $searchType == "conversation" or $searchType == "searchWord"){
        // user_fieldsは重複した場合1つしか帰らない(1idで2tweet取れた場合、dataは2,usersは1)ので検索する。
        // curlの返信結果が{data:[],includes:{users:[],media[]},meta;{}}になっているので検索用に並列化
        foreach( $responseJsonText->includes->users as $user ){
          array_push($parts_name , $user->username);
          array_push($parts_id , $user->id);
        }
        foreach( $responseJsonText->data as $key => $data ){
          $data->username = $parts_name[array_search($data->author_id,$parts_id)];
          $data->searchType = $searchType;
        }
      }

      // 件数の加算とデータの退避
      $roop_count++;
      // originalの場合はmeta情報がセットされないので除外、while繰り返されるのはconveersationのみ
      switch ($searchType) {
        case "original":
          $arrayDataS = array_merge($arrayDataS,$responseJsonText->data );
          $tweet_count = 1;
          break;
        case "conversation":
          $tweet_count += $responseJsonText->meta->result_count;
          $arrayDataS = array_merge($arrayDataS,$responseJsonText->data );
          break;
        case "reTweet":
          $tweet_count = count($arrayDataS);
          break;
        case "searchWord":
          $tweet_count += $responseJsonText->meta->result_count;
          $arrayDataS = array_merge($arrayDataS,$responseJsonText->data );
          break;
      }
    endwhile;

    // $return = (object)(["statuses" => array_reverse($arrayDataS),"search_metadata" => array_reverse($arrayDataM)]);
    $return = (object)(["statuses" => array_reverse($arrayDataS) , "count" => $tweet_count]);

    return $return;
  }

  public function curlCoal($searchType,$request,$nextToken){

    $KEY = 'AAAAAAAAAAAAAAAAAAAAACwgHwEAAAAAtDtHjGC9fhSdqbYdcPQIOTb%2Fd%2F0%3DgfB2IdydyYfyw9Ao1YXLZ440FWyS491QzYNc02zs5OyTeMwyjb';

    $base = "https://api.twitter.com/2/tweets";

    if($searchType == "conversation" ){
      $param = "/search/recent?query=conversation_id:" . $request->tweetId;
      $param = $param . "&max_results=100";
    }elseif($searchType == "reTweet"){
      // reTweetはv2だと検索機能がまだ機能していないのでv1.1でっとってくる。
      $base = 'https://api.twitter.com/1.1/statuses/retweets/';
      $param = $request->tweetId . '.json';
      $param = $param . "?count=100";
    }elseif($searchType == "original"){
      $param = "?ids=" . $request->tweetId;
    }elseif($searchType == "searchWord"){

      // paramの確認用。苦戦したので残しておく。
      // $param = "/search/recent?query=from:twitterdev";

      // uriに日本語を混ぜるときは16進に変換してから渡す
      $param = "/search/recent?query=" . urlencode($request->searchWord);

      // retweetの除外
      $param = $param . urlencode(" ") . "-is:retweet";

      if($request->selectLang == 0){
        $param = $param . urlencode(" ") . "lang:en";
      }

      // これも効かない。効きそうだんだがなぁ。
      // $param = $param . urlencode(" ") . "since:2021-06-14";
      // 返信の最小件数を指定、これが効けばdisplayBorderの設定は不要⇒効かないのでいれないこと。
      if($request->minReply > 0){
        dd("できそうでできないmin_replies。0で検索すれば検索文から除外できるので0で検索すること。");
        $param = $param . urlencode(" ") . "min_replies:" . (int)$request->minReply;
      }

      $param = $param . "&max_results=100";
    }

    // dd($param);

    // reTweetはv1.1で取ってくるのでこのへんが設定できない
    if($searchType = "original" or $searchType = "conversation" or $searchType = "searchWord"){
      $param = $param . "&expansions=author_id,attachments.media_keys,referenced_tweets.id";
      $param = $param . "&media.fields=preview_image_url,type";
      $param = $param . "&place.fields=country,country_code";
      $param = $param . "&tweet.fields=created_at,lang,conversation_id,public_metrics";
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

    return $returnText;
  }

  public function curlCoalGAS($gasSetText){

    // oogle翻訳。 curlコマンドで実行するときのコマンドは以下。
    // curl -d '{"text":"hello", "source":"en","target":"ja"}' -L https://script.google.com/macros/s/AKfycbySxRYYZ_23oXT1gn-4d2mkXhk6f9gj6ywynCKmAASiojvvroZf/exec
    $params = array('text' => $gasSetText,'source' => "en",'target' => "ja");
    $sendURL = "https://script.google.com/macros/s/AKfycbySxRYYZ_23oXT1gn-4d2mkXhk6f9gj6ywynCKmAASiojvvroZf/exec";

    $curl = curl_init($sendURL);      // curlの処理を始める合図
    curl_setopt($curl, CURLOPT_POST, true); //POST送信
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params)); //postするデータの格納（json）
    curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);//Locationをたどる
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);//文字列で結果を返させる

    // 制限overで実行できない時にコメントアウトする。
    $response = curl_exec($curl);// レスポンスを変数に入れる

    curl_close($curl);// curlの処理を終了

    // 制限overで実行できないときはコメントアウトする。
    if( !empty($response) ){
      $returnGAS = json_decode( $response );
      return $returnGAS;
    }

  }

}
