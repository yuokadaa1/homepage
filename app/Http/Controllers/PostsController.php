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

  //     +request: Symfony\Component\HttpFoundation\ParameterBag {#44 ▼
  // #parameters: array:10 [▼
  //   "_token" => "bM4uzDR9nx4DDFFN3LRJosVe9e2fFZVvUfKsibvQ"
  //   "selectPair" => "2"
  //   "inputRate" => "1.3925"
  //   "numNetAssets" => "1000000"
  //   "selBuySell" => "0"
  //   "selLeverage" => "0"
  //   "numAmount" => "100"
  //   "selMaintenanceRate" => "9"
  //   "numSettlement" => "1300000"
  //   "button1" => "計算開始"
  // ]
  
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
      $getArrayPrice = array();
      if($request->selectDays == 1){
        $getArrayPrice = $this->fGoute(0,$urlStock,0);
      }else {
        for($i = 0; $i <  $request->selectDays - 1; $i++){
          $getArrayPrice = array_merge($getArrayPrice,$this->fGoute(1,$urlStock,$i));
        }
      }

      // keyでソート
      ksort($getArrayPrice);

      // SpreadSheetから為替情報を取得
      // curl  -d  '{"execType":"1", "pricePeriod":["2021-01-01","2021-01-02","2021-01-03","2021-01-04","2021-01-05","2021-01-06"]}' -L https://script.google.com/macros/s/AKfycbzPieZWZ8_m_KkaWypUiE8V9vALCH8n7lsVjEblz8QdH2fddrJX04Fx/exec
      $sendURL = "https://script.google.com/macros/s/AKfycbzPieZWZ8_m_KkaWypUiE8V9vALCH8n7lsVjEblz8QdH2fddrJX04Fx/exec";
      $sendDate = array_keys($getArrayPrice);
      // $sendDate = ["2021-01-01","2021-01-02"];
      $returnAPI = $this->curlCoalGAS($sendURL,$sendDate);

      $i = 0;
      $returnPriceS = array();
      foreach ( $getArrayPrice as $arrayDate => $sPrice ) {
        $returnPrice = array();
        $returnPrice["Date"] = $arrayDate;
        $returnPrice["Open"] = $sPrice["Open"] * $returnAPI->message[$i];
        $returnPrice["High"] = $sPrice["High"] * $returnAPI->message[$i];
        $returnPrice["Low"] = $sPrice["Low"] * $returnAPI->message[$i];
        $returnPrice["Close"] = $sPrice["Close"] * $returnAPI->message[$i];
        $returnPrice["Volume"] = $sPrice["Volume"];
        array_push($returnPriceS,$returnPrice);
        $i++;
      }

      return json_encode($returnPriceS);
    }

    // GASへのcurlはたぶんどこでも使うので関数化しておく。
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




    public function fGoute($execType,$getURL,$addURL){

      if($execType == 1){
        $getURL = $getURL . (date("Y") - $addURL) . "/";
      }

      $crawler = \Goutte::request('GET', $getURL);

      $crawlerStock = array();
      $crawlerStock =  array_merge($crawlerStock,$crawler->filter('table')->eq(0)->filter('tr')->each(function($element) {
        if(count($element->filter('td'))){
          return array(
            $element->filter('td')->eq(0)->text() => array(
              'Open' => $element->filter('td')->eq(1)->text(),
              'High' => $element->filter('td')->eq(2)->text(),
              'Low' => $element->filter('td')->eq(3)->text(),
              'Close' => $element->filter('td')->eq(4)->text(),
              'Volume' => $element->filter('td')->eq(5)->text()
            )
          );
        }
      }));
      $organizePrice = array();
      // 年度ごとの配列の中に日杖をキーとする連想配列として格納されている。 array[年のリンク数][array[date][5]]
      $crawlerStock = array_filter($crawlerStock);
      foreach($crawlerStock as $sPrice){
        if(isset($sPrice)){
          $organizePrice = array_merge($organizePrice,$sPrice);
        }
      }
      return $organizePrice;

    }



}
