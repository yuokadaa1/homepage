<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//Laravel-Excelの導入
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelType;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Storage;


class GetSwapRateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:GetSwapRateCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'IG証券のスワップレートを取得してスプレッドシートに更新';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // ここに処理を記述
        echo "実行開始：" . "\n";
        echo "Excel操作開始" . "\n";

        // データの中身を見るためにいったんコメントアウト化
        $getExcel = file_get_contents('https://www.ig.com/content/dam/publicsites/igcom/jp/files/swap/Japanese%20Swap%20Rates.xlsx');
        Storage::put('iGSwap.xlsx', $getExcel);

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load("storage/app/iGSwap.xlsx");
        $sheet = $spreadsheet->getActiveSheet();
        //Excelの最終行を取得(たまにnullセルが居るようなのでNULL判定して値の入っているセルまで戻す)
        $max_row_tmp = $sheet -> getHighestRow();
        while($sheet -> getCell("A{$max_row_tmp}") -> getValue() == NULL) $max_row_tmp--; //値が取得できるまで、デクリメントする

        $data = [];
        $swapPoint = array();
        $position = array();
        $swapYMD = 0;
        $nextGetColumn = "";

        foreach ($sheet->getRowIterator() as $i => $row) {
            $row_data = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            foreach ($cellIterator as $j => $cell) {

              // $i:行No=Row. $j:列No=Column. ->だから$dataの配列は1スタート
              $cell_id = $i .'-'. $j;
              $row_data[$cell_id] = $cell->getValue();

              // 対象通貨の捜索、なぜか 0 が = USDJPY に引っかかってしまうので除外。
              if ( $cell->getValue() == "USDJPY" and $cell->getValue() <> "0"){
                $position["USDJPY"]["Row"] = $i;
                $position["USDJPY"]["Column"]  = $j;
              }elseif( $cell->getValue() == "USDKRW" and $cell->getValue() <> "0" ){
                $position["USDKRW"]["Row"] = $i;
                $position["USDKRW"]["Column"]  = $j;
              }elseif( $cell->getValue() == "GBPUSD" and $cell->getValue() <> "0" ){
                $position["GBPUSD"]["Row"] = $i;
                $position["GBPUSD"]["Column"]  = $j;
              }elseif( $cell->getValue() == "GBPJPY" and $cell->getValue() <> "0" ){
                $position["GBPJPY"]["Row"] = $i;
                $position["GBPJPY"]["Column"]  = $j;
              }

              // 最終行（最新のスワップポイントの格納位置）のみデータを取得
              if($i == $max_row_tmp){

                // shortの次行がLongなので、shortを格納した次の行でLongを格納
                if ( $nextGetColumn <> ""){
                  $swapPointdata["swapPointLong"] = $cell->getValue();
                  $swapPoint[$nextGetColumn] = $swapPointdata;
                  $nextGetColumn = "";
                }

                if( $j == "A" ){
                  $swapYMD = $cell->getValue();
                }elseif( $j == $position["USDJPY"]["Column"] ){
                  $swapPointdata = array(
                    "currency" => "USDJPY",
                    "swapPointShort" => $cell->getValue(),
                    "updateDateS" => $swapYMD
                  );
                  $nextGetColumn = "USD/JPY";
                }elseif( $j == $position["USDKRW"]["Column"] ){
                  $swapPointdata = array(
                    "currency" => "USDKRW",
                    "swapPointShort" => $cell->getValue(),
                    "updateDateS" => $swapYMD
                  );
                  $nextGetColumn = "USD/KRW";
                }elseif( $j == $position["GBPUSD"]["Column"] ){
                  $swapPointdata = array(
                    "currency" => "GBPUSD",
                    "swapPointShort" => $cell->getValue(),
                    "updateDateS" => $swapYMD
                  );
                  $nextGetColumn = "GBP/USD";
                }elseif($j == $position["GBPJPY"]["Column"]){
                  $swapPointdata = array(
                    "currency" => "GBPJPY",
                    "swapPointShort" => $cell->getValue(),
                    "updateDateS" => $swapYMD
                  );
                  $nextGetColumn = "GBP/JPY";
                }

              }
                // echo "Excelに格納されている値：" . $cell_id . " : " . $cell->getValue() . "\n";
            }
            $data[$i] = $row_data;
        }

        // echoの出し方 and データの格納方法
        // echo "USDJPYの位置：" . $data[372]["372-IL"] . "\n";
        // echo "USDJPYの格納：" . var_export($swapPoint, true) . "\n";

        $data = json_encode($swapPoint,JSON_UNESCAPED_SLASHES);
        echo "送信するjsonデータ：" . var_export($data, true) . "\n";

        // ストリームコンテキストのオプションを作成
        $options = array(
          // HTTPコンテキストオプションをセット
          'http' => array(
          'method'=> 'POST',
          'header'=> 'Content-type: application/json; charset=UTF-8', //JSON形式で表示
          'content' => $data
          )
        );

        // ストリームコンテキストの作成
        $context = stream_context_create($options);
        $sendURL = "https://script.google.com/macros/s/AKfycbz7wyroDPF5jpkooStIQhhPWoc2-avrs9SUUdkL5n3DVXLAjHbK/exec";
        // POST送信
        $contents = file_get_contents($sendURL, false, $context);
        echo "Post送信の結果：" . $contents;


    }
}
