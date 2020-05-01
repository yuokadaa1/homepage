<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Index;
use App\Meigara;


//useしないと 自動的にnamespaceのパスが付与されるのでuse
use SplFileObject;

class AdminController extends Controller
{

  public function update (){return view('admin.update');}

  public function import($kbn,Request $request)
  {
    switch ($kbn) {
      case "meigara":
          $this->meigaraUpdate();
          break;
      case "index":
          $this->indexUpdate($request);
          break;
        }
    return view('admin.update');
  }

  private function meigaraUpdate(){

    //～ここからcontroller内で作成した時の処理。一応保存しておく。
    //
    //なんやかやデータ操作しないとそのまま読み込めなかった。json_decodeで処理できないものが含まれていた。
    // ''を""に、""なしデータを""ありデータに
    // https://chaika.hatenablog.com/entry/2017/07/01/080000
    // 2020041001の時はjsonデータを読み込む→配列に格納
    // $jsonData = Storage::get('public/20200416_1306_T.csv');
    $jsonData = Storage::get('public/20200421_1306_T.csv');
    $arrayJson = json_decode($jsonData,true);

    // unixタイムスタンプを日本時間に変換する。
    date_default_timezone_set('Asia/Tokyo');
    foreach ($arrayJson["timestamp"] as &$value) {
      // 取得したタイムスタンプはms秒、変換は秒までなのでms秒を除外
      // $value = date('Y年m月d日 H:i', ($value / 1000));
      $value = date('Y-m-d H:i', ($value / 1000));
      // $value = date('Ymd H:i', ($value / 1000));
    }

    for($i = 0; $i < count($arrayJson["timestamp"]) ; $i++){
      // viewで拾えるように[key1:[],key2:[],key3[]の形を][[key1:,key2:,key3],[key1:,key2:,key3]...に修正]
      $array["timestamp"] = $arrayJson["timestamp"][$i];
      $array["high"] = $arrayJson["high"][$i];
      $array["low"] = $arrayJson["low"][$i];
      $array["open"] = $arrayJson["open"][$i];
      $array["close"] = $arrayJson["close"][$i];
      $array["volume"] = $arrayJson["volume"][$i];
      $arrayData[] = $array;
      array_push($arrayData,$array);

      //解析用にデータを格納
      Meigara::unguard(); // セキュリティー解除
      $meigara = Meigara::updateOrCreate(
        ['meigaraCode' => "1306",
        'meigaraCodeA' => '',
        'date' => substr($arrayJson["timestamp"][$i],0,10),   //yyyy-mm-dd hh:ii
        'time' => substr($arrayJson["timestamp"][$i],11,5)],  //0123-56-89 BC:EF
        ['openingPrice' => $arrayJson["open"][$i],            //"2020-02-25 09:00"
        'highPrice' => $arrayJson["high"][$i],
        'lowPrice' => $arrayJson["low"][$i],
        'openingPrice' => $arrayJson["open"][$i],
        'closingPrice' => $arrayJson["close"][$i],
        'volume' => $arrayJson["volume"][$i]
       ]
      );
     Meigara::reguard(); // セキュリティーを再設定

    //～ここまでcontroller内で作成した時の処理。一応保存しておく。


    }


  }

  private function indexUpdate(Request $request){

    // ロケールを設定(日本語に設定)
    setlocale(LC_ALL, 'ja_JP.UTF-8');

    // アップロードしたファイルを取得
    // 'csv_file' はビューの inputタグのname属性
    $uploaded_file = $request->file('csv_file');

    // アップロードしたファイルの絶対パスを取得
    $file_path = $request->file('csv_file')->path($uploaded_file);

    //SplFileObjectを生成
    $file = new SplFileObject($file_path);

    //SplFileObject::READ_CSV が最速らしい
    $file->setFlags(SplFileObject::READ_CSV);

    $row_count = 1;

    //取得したオブジェクトを読み込み
    foreach ($file as $row)
    {
        // 最終行の処理(最終行が空っぽの場合の対策
        if ($row === [null]) continue;

        // 1行目のヘッダーは取り込まない
        if ($row_count > 1)
        {

          Index::unguard(); // セキュリティー解除
          $index = Index::updateOrCreate(
            ['index' => "DJIA",
             'date' => $row[0]
             // 'time' => ,
            ],
            ['openingPrice' => $row[1],
             'highPrice' => $row[2],
             'lowPrice' => $row[3],
             'closingPrice' => $row[4],
             'beforeRatio' => $row[5],
             'beforeRatioP' => $row[6]
            ]
          );
          Index::reguard(); // セキュリティーを再設定
        }
        $row_count++;
    }
  }

}
