<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter extends Controller
{

  public function index()
  {
    return view('twitter.index');
  }


  public function search(Request $request)
  {

    // URLで検索した場合、構成されているURLからtweetID,tweetUserに分解
    if( isset($request->button3) ){
      // https://twitter.com/FXCM_MarketData/status/1312934570359230464 から twitterUser,twitterId を取得する。
      // $address1 = preg_split("\/\/",$request->searchURL);
      $address1 = parse_url($request->searchURL);
      $address2 = explode("/",$address1['path']);
      $request->tweetId = $address2[3];
      $request->userName = $address2[1];
    }

    // API-Keyをセット
    $consumer_key = 'KXyKtE0r69bZmrTJRaFg6mK6L';
    $consumer_key_sercret = 'An2Ksaz7GDRtUx9kvFkamwudTveRi6KwdmxsrBEQRLsqw7JwJl';
    $access_token = '1027141767055851522-L6c646ZGZubX1kTWAZoHLmtjdcAYhG';
    $access_token_secret = '6F07mlmmzyfgcXoSsUiPFMC0NmhiBTxcgeNHShvpvS5Vk';
    $connection = new TwitterOAuth($consumer_key, $consumer_key_sercret, $access_token, $access_token_secret);

    $tweet_count = 0;
    $roop_count = 0;
    $arrayDataS = array();
    $arrayDataM = array();

    // APIの検索キーのセット
    if( empty( $request->searchWord ) ){
      //ユーザIDによる検索。
      $params = array('q' => $request->userName . " exclude:retweets" ,'count' => 100,);
    } else {
      // テキスト本文による検索
      $params = array('q' => $request->searchWord . " exclude:retweets" ,'count' => 100,);
    }

    // 一回100件までしか取得できないので取得件数が400まで,10回ループまで繰り返す。
    while ( $tweet_count < 100 and $roop_count < 2):
      // APIの呼び出し
      // $tweets = $connection->get("search/tweets", ['q' => $params , 'count' => 20] );
      $tweets = $connection->get("search/tweets", $params );

      // エラーが出てきたらddして中断。
      if( empty($tweets->errors) ){
      } else {
        dd($tweets);
      }

      // 1週間以内にtweetがないとstatusesが0になるので0が返ってきたときは繰り返しを終了させる。
      if( count($tweets->statuses) == 0 ){
        $tweet_count = 99999;
      }

      // 取ってきたreturn件数を繰り返し判定に加算
      $tweet_count += count($tweets->statuses);

      // next_resutsが入っていた場合、まだデータが残っているのでパラメータを再設定して呼び直し。
      if( empty( $tweets->search_metadata->next_results ) ){
        // next_results is empty はもう次がないとき。
        $tweet_count = 99999;
      }else{
        // next_results に 検索parameter + 取得件数　を含む際呼び出しパラメータが設定されているのでセット。
        $params['next'] =  preg_replace('/^\?/', '', $tweets->search_metadata->next_results);
      }

      $roop_count++;
      $arrayDataS = array_merge($arrayDataS,$tweets->statuses );
      $arrayDataM[] = (array)$tweets->search_metadata;

    endwhile;

    // 取得したデータを逆順でcollectionにセット（最新順に取得されてしまうため。）
    $tweets->statuses = array_reverse($arrayDataS);
    $tweets->search_metadata = array_reverse($arrayDataM);

    if( empty($request->{'searchWord'}) ){
      $return = array();
      // ユーザIDで検索のため、該当tweetとは無関係のリプライが含まれてしまうので除外する。
      foreach ($tweets->statuses as $tweet){
        //検索条件に該当するリプライでないものは除外
        if( empty($tweet->in_reply_to_user_id_str) and $tweet->id <> $request->tweetId ){
          // empty=リプライでない、tweet本体でない場合は読み捨てる
        }else if( $tweet->in_reply_to_user_id_str = $request->tweetId or
                  $tweet->id = $request->tweetId ){
          // 中身が入っていて、かつtweetIdが一致するもののみ戻す。
          // 戻す際に日付をctime形式からymdに変換
          $tweet->created_at = date("Y-m-d h:i:s",strtotime($tweet->created_at));

          // ついでにgoogle翻訳もかけておく
          // curlコマンドで実行するとき。
          // curl -d '{"text":"hello", "source":"en","target":"ja"}' -L https://script.google.com/macros/s/AKfycbySxRYYZ_23oXT1gn-4d2mkXhk6f9gj6ywynCKmAASiojvvroZf/exec

          $params = array('text' => $tweet->text,'source' => "en",'target' => "ja");
          $sendURL = "https://script.google.com/macros/s/AKfycbySxRYYZ_23oXT1gn-4d2mkXhk6f9gj6ywynCKmAASiojvvroZf/exec";

          $curl = curl_init($sendURL);      // curlの処理を始める合図
          curl_setopt($curl, CURLOPT_POST, true); //POST送信
          curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($params)); //postするデータの格納（json）
          curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);//Locationをたどる
          curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);//文字列で結果を返させる
          $response = curl_exec($curl);// レスポンスを変数に入れる
          curl_close($curl);// curlの処理を終了

          $returnAPI = json_decode( $response ) ;

          // $returnParts = array('id' => $tweet->id,'created_at' => $tweet->created_at,'text' => $tweet->text , 'textJp' => $returnAPI->message, 'user'->screen_name => $tweet->user->screen_name);
          // 通信量削減のため戻す項目を絞る。絞らない場合は textJpを$tweetにセットするだけ。
          $returnParts = array();
          $returnParts['id'] = $tweet->id;
          $returnParts['created_at'] = $tweet->created_at;
          $returnParts['text'] = $tweet->text;
          $returnParts['textJp'] = $returnAPI->message;
          $returnParts['screen_name'] = $tweet->user->screen_name;

          array_push( $return , (object)$returnParts );

          // 項目絞らない判。どっちがはやいかわからん。（viewのscreen_nameをuser->に直す必要がある。）
          // $tweet->textJp = $returnAPI->message;
          // array_push( $return , $tweet );
        }
      }
      $tweets =  (object)['statuses' => $return];
    }

    return view('twitter.index')->
          with(['getTweets' => $tweets , 'inputURL' => $request->searchURL ,
                'tweet_count' => $tweet_count , 'tweet_count_all' => count($tweets->statuses)]);;
  }

}
