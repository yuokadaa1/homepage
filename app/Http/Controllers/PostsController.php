<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\import_csv;
use App\Post;
use App\Index;
use App\Meigara;
use Illuminate\Support\Facades\DB;


class PostsController extends Controller
{
    public function index() {
      return view('welcome');
    }

    public function blog() {
      return view('posts.index');
    }

    // getで呼ばれた時用のfunction
    public function blogDetail($id) {

      switch ($id) {
        case "2020041001":
          $arrayData = $this->b2020041001();
          return view('blogs.' . $id)->with('json',$arrayData);
        case "2020052701":
          $arrayData = $this->b2020052701();
          return view('blogs.' . $id)->with('json',$arrayData);
        default:
          return view('blogs.' . $id);
      }

    }

    // postで呼ばれた時用のfunction
    public function blogDetailP($id,Request $request) {

      switch ($id) {
        case "2020052701":
          $arrayData = $this->b2020052701($request);
          // button2で呼ばれた時はレートの再取得のみ。
          if($request->button2 <> ""){
            $arrayData2 = "";
          }else{
            $arrayData2 = $this->b2020052702($request,$arrayData);
          }
          return view('blogs.' . $id)->with(['json'=>$arrayData,'json2'=>$arrayData2,'requestD'=>$request]);
        case "2021020101":
          $arrayData = $this->b2021020101($request);
          return view('blogs.' . $id)->with('json',$arrayData);
        default:
          return view('blogs.' . $id);
      }

    }


    private function b2020041001(){

      $indexData = DB::select(DB::raw('
      SELECT m1.meigaraCode as meigaraCode,
             m1.date AS date,
             m1.time AS time,
             m1.openingPrice as openingPrice,
             m1.closingPrice as closingPrice,
             m1.highPrice as highPrice,
             m1.lowPrice as lowPrice,
             m1.volume as volume,
             m4.openingPrice AS todayOpening,
             m2.closingPrice AS lastClosing,
             m2.date as lastDate,
             m2.time as lastTime,
             m5.closingPrice AS amClosing,
             gpif.ETF as BOJETF,
             "" as beforeRatio,
             "" as beforeRatioP
      FROM meigaras as m1
      INNER JOIN meigaras as m2
              ON m2.date = (SELECT MAX(m3.date)
                            FROM meigaras as m3
                            WHERE m3.date < m1.date and m3.time = "09:00:00")
                    		  and m2.time = "14:30:00"
      INNER JOIN meigaras as m4
              on m1.date = m4.date
              and m4.time = "09:00:00"
      INNER JOIN meigaras as m5
              on m1.date = m5.date
              and m5.time = "11:00:00"
      INNER JOIN gpifs as gpif
      on gpif.date = m1.date
      WHERE m1.time in ("09:00:00","11:00:00","12:30:00","14:30:00","13:00:00","13:30:00","14:00:00")
        and m1.date > "2020-02-24"
      union
      SELECT "DJIA" as meigaraCode,
      		indices.date AS date,
      		indices.time AS time,
              indices.openingPrice as openingPrice,
              indices.closingPrice as closingPrice,
              indices.highPrice as highPrice,
              indices.lowPrice as lowPrice,
              indices.volume as volume,
              "" AS todayOpening,
              "" AS lastClosing,
              "" as lastDate,
              "" as lastTime,
              "" AS amClosing,
              "" as BOJETF,
              indices.beforeRatio as beforeRatio,
              indices.beforeRatioP as beforeRatioP
      from indices
      where indices.date > "2020-02-24"
      order by date asc,meigaraCode asc,time asc
      '));

      return $indexData;
    }

    private function b2020052701(){
      $url = "https://spreadsheets.google.com/feeds/list/1BLvpJeMemQK_WA6mCBkonMVWOjv9xhGGrihMaAa2hFs/od6/public/values?alt=json";

      $json = file_get_contents($url);
      $json_decode = json_decode($json);
      $names = $json_decode->feed->entry;

      $json = array();
      foreach ($names as $name) {
        $excel['cid'] = $name->{'gsx$cid'}->{'$t'};;
        $excel['currency'] = $name->{'gsx$currency'}->{'$t'};;
        $excel['price'] = $name->{'gsx$price'}->{'$t'};
        $excel['time'] = $name->{'gsx$time'}->{'$t'};
        $excel['change'] = $name->{'gsx$change'}->{'$t'};
        $excel['swapPointShort'] = $name->{'gsx$swappointshort'}->{'$t'};
        $excel['swapPointLong'] = $name->{'gsx$swappointlong'}->{'$t'};
        $excel['rollDays'] = $name->{'gsx$rolldays'}->{'$t'};
        $excel['updateDateS'] = $name->{'gsx$updatedates'}->{'$t'};
        array_push($json, $excel);
      }

      return $json;
    }

    private function b2020052702(Request $request,$arrayData){
      $input["BuySell"] = $request->selBuySell;
      // switch ($request->selectPair) {
      //   case "1"
      //     return ;
      //   case "2"
      //     return ;
      // }

      if($arrayData[$request->selectPair]["change"] == "No"){
        // 円取引の場合（ドル円変換が必要ない）

        // 必要証拠金額　= 購入Lot(入力欄 * 100) * レート / レバレッジ倍率
        $requiredMargin = $request->numAmount * 100 * $arrayData[$request->selectPair]["price"] / 25;
        // ロスカット基準額 = 総資産 - 必要証拠金
        $remainderMoney = $request->numNetAssets - $requiredMargin;
        // ロスカット発生までのpips ロスカット発生までの金額 / 保有数量
        $remainderpips = $remainderMoney / ($request->numAmount * 100);
        // ロスカット発生のレート金額
        if($request->selectPair == 0){
          // 買いの場合
          $lossCutRate = $arrayData[$request->selectPair]["price"] + $remainderpips;
          $swapPoint = $arrayData[$request->selectPair]["swapPointLong"];
        }else{
          // 売りの場合
          $lossCutRate = $arrayData[$request->selectPair]["price"] - $remainderpips;
          $swapPoint = $arrayData[$request->selectPair]["swapPointShort"];
        }
        $json["requiredMargin"] = $requiredMargin;
        $json["remainderMoney"] = $remainderMoney;
        $json["remainderpips"] = $remainderpips;
        $json["lossCutRate"] = $lossCutRate;
        $json["swapPoint"] = $swapPoint;

      }else{
        dd("大失敗");
      }

      return $json;
    }


    private function b2021020101(Request $request){

      $inputTSECode = $request->tseCode;
      $urlStock = "https://kabuoji3.com/stock/".$inputTSECode."/";
      $crawler = \Goutte::request('GET', $urlStock);

      $stockPrice = array();
      // 7203のTOPページを取得
      $stockPrice += $crawler->filter('a')->each(function($element) use ($urlStock){
      // $stockPrice = array_merge($stockPrice,$crawler->filter('a')->each(function($element) use ($urlStock){

        // hrefリンク(//https://kabuoji3.com/stock/7203/2018/)のurlが7203のアドレスと一致したものを対象に
        if (0 === strpos($element->attr('href'), $urlStock)) {

          // 条件を一致したページに対してcrawling開始
          $crawlerLi = \Goutte::request('GET', $element->attr('href'));

          $crawlerStock = array();
          $crawlerStock += $crawlerLi->filter('table')->eq(0)->filter('tr')->each(function($element) {
            $uri = explode("/", $element->getUri());
            // 対象年月で絞りこみ（URIで操作しているのでここでできるのは年度のみ）
            if($uri[5] != "" and (int)$uri[5] > 2019){

              if(count($element->filter('td'))){
                return array(
                  'Date' => $element->filter('td')->eq(0)->text(),
                  'Open' => $element->filter('td')->eq(1)->text(),
                  'High' => $element->filter('td')->eq(2)->text(),
                  'Low' => $element->filter('td')->eq(3)->text(),
                  'Close' => $element->filter('td')->eq(4)->text(),
                  'Volume' => $element->filter('td')->eq(5)->text()
                     // 'tradingValue' => $element->filter('td')->eq(6)->text()
                );
              }
            }
          });

        };
          if(!empty($crawlerStock)){return $crawlerStock;}
      });
      $aaa = array();
      // 年度ごとの配列の中に日杖をキーとする連想配列として格納されている。 array[年のリンク数][array[date][5]]
      $stockPrice = array_filter($stockPrice);
      dd($stockPrice);
      // ksort($stockPrice);
      foreach($stockPrice as $sPrice){
        if(isset($sPrice)){
          foreach($sPrice as $sPrice2){
            if(isset($sPrice2)){
              array_push($aaa,$sPrice2);
              // array_push($sendDate,$sPrice2->Date);
            }
          }
        }
      }
      dd($aaa);

      // curl  -d  '{"execType":"1", "pricePeriod":["2021/01/01","2021/01/02","2021/01/03","2021/01/04","2021/01/05","2021/01/06"]}' -L https://script.google.com/macros/s/AKfycbzPieZWZ8_m_KkaWypUiE8V9vALCH8n7lsVjEblz8QdH2fddrJX04Fx/exec
      $sendURL = "https://script.google.com/macros/s/AKfycbzPieZWZ8_m_KkaWypUiE8V9vALCH8n7lsVjEblz8QdH2fddrJX04Fx/exec";
      $sendDate = array_column( $aaa, 'Date' );
      $returnAPI = $this->curlCoalGAS($sendURL,$sendDate);
      dd($returnAPI);

      return json_encode($aaa);
    }

    public function curlCoalGAS($gasURL,$gasSetText){


      $params = array("execType" => "1","pricePeriod" => $gasSetText);


      $curl = curl_init($gasURL);      // curlの処理を始める合図
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
