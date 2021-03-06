<?php

use Illuminate\Database\Seeder;

class GPIFSTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       // テーブルのクリア
       DB::table('gpifs')->truncate();

       // 初期データ用意（列名をキーとする連想配列）
       //空文字を許容されないので-を除外（一括変換防止用の-を除外してから）これは変換で削除する。
       //[,-	'ETF' => '']
       //[ ,-	'support' => '']
       //[,-	'J-REIT' => '']
       $gpifD = [
          ['date' => '2020/01/01'],
          ['date' => '2020/01/02'],
          ['date' => '2020/01/03'],
          ['date' => '2020/01/04'],
          ['date' => '2020/01/05'],
          ['date' => '2020/01/06',	'ETF' => '702',	'support' => '12'],
          ['date' => '2020/01/07',	'support' => '12'],
          ['date' => '2020/01/08',	'ETF' => '702',	'support' => '12'],
          ['date' => '2020/01/09',	'support' => '12'],
          ['date' => '2020/01/10',	'support' => '12'],
          ['date' => '2020/01/11'],
          ['date' => '2020/01/12'],
          ['date' => '2020/01/13'],
          ['date' => '2020/01/14',	'support' => '12'],
          ['date' => '2020/01/15',	'ETF' => '702',	'support' => '12'],
          ['date' => '2020/01/16',	'support' => '12'],
          ['date' => '2020/01/17',	'support' => '12'],
          ['date' => '2020/01/18'],
          ['date' => '2020/01/19'],
          ['date' => '2020/01/20',	'support' => '12'],
          ['date' => '2020/01/21',	'support' => '12'],
          ['date' => '2020/01/22',	'support' => '12'],
          ['date' => '2020/01/23',	'support' => '12'],
          ['date' => '2020/01/24',	'support' => '12'],
          ['date' => '2020/01/25'],
          ['date' => '2020/01/26'],
          ['date' => '2020/01/27',	'ETF' => '702',	'support' => '12',	'J-REIT' => '12'],
          ['date' => '2020/01/28',	'ETF' => '702',	'support' => '12'],
          ['date' => '2020/01/29',	'support' => '12'],
          ['date' => '2020/01/30',	'ETF' => '702',	'support' => '12'],
          ['date' => '2020/01/31',	'support' => '12'],
          ['date' => '2020/02/01'],
          ['date' => '2020/02/02'],
          ['date' => '2020/02/03',	'ETF' => '703',	'support' => '12',	'J-REIT' => '12'],
          ['date' => '2020/02/04',	'support' => '12'],
          ['date' => '2020/02/05',	'support' => '12'],
          ['date' => '2020/02/06',	'support' => '12'],
          ['date' => '2020/02/07',	'support' => '12'],
          ['date' => '2020/02/08'],
          ['date' => '2020/02/09'],
          ['date' => '2020/02/10',	'support' => '12'],
          ['date' => '2020/02/11'],
          ['date' => '2020/02/12',	'support' => '12'],
          ['date' => '2020/02/13',	'support' => '12'],
          ['date' => '2020/02/14',	'ETF' => '703',	'support' => '12'],
          ['date' => '2020/02/15'],
          ['date' => '2020/02/16'],
          ['date' => '2020/02/17',	'ETF' => '703',	'support' => '12'],
          ['date' => '2020/02/18',	'ETF' => '703',	'support' => '12'],
          ['date' => '2020/02/19',	'support' => '12'],
          ['date' => '2020/02/20',	'support' => '12'],
          ['date' => '2020/02/21',	'support' => '12'],
          ['date' => '2020/02/22'],
          ['date' => '2020/02/23'],
          ['date' => '2020/02/24'],
          ['date' => '2020/02/25',	'ETF' => '703',	'support' => '12'],
          ['date' => '2020/02/26',	'ETF' => '703',	'support' => '12',	'J-REIT' => '12'],
          ['date' => '2020/02/27',	'ETF' => '703',	'support' => '12',	'J-REIT' => '12'],
          ['date' => '2020/02/28',	'ETF' => '703',	'support' => '12',	'J-REIT' => '12'],
          ['date' => '2020/02/29'],
          ['date' => '2020/03/01'],
          ['date' => '2020/03/02',	'ETF' => '1002',	'support' => '12'],
          ['date' => '2020/03/03',	'support' => '12'],
          ['date' => '2020/03/04',	'support' => '12'],
          ['date' => '2020/03/05',	'support' => '12'],
          ['date' => '2020/03/06',	'ETF' => '1002',	'support' => '12',	'J-REIT' => '12'],
          ['date' => '2020/03/07'],
          ['date' => '2020/03/08'],
          ['date' => '2020/03/09',	'ETF' => '1002',	'support' => '12',	'J-REIT' => '12'],
          ['date' => '2020/03/10',	'ETF' => '1002',	'support' => '12',	'J-REIT' => '12'],
          ['date' => '2020/03/11',	'support' => '12'],
          ['date' => '2020/03/12',	'ETF' => '1002',	'support' => '12',	'J-REIT' => '12'],
          ['date' => '2020/03/13',	'ETF' => '1002',	'support' => '12',	'J-REIT' => '12'],
          ['date' => '2020/03/14'],
          ['date' => '2020/03/15'],
          ['date' => '2020/03/16',	'support' => '12',	'J-REIT' => '15'],
          ['date' => '2020/03/17',	'ETF' => '1204',	'support' => '12',	'J-REIT' => '20'],
          ['date' => '2020/03/18',	'support' => '12',	'J-REIT' => '20'],
          ['date' => '2020/03/19',	'ETF' => '2004',	'support' => '12',	'J-REIT' => '40'],
          ['date' => '2020/03/20'],
          ['date' => '2020/03/21'],
          ['date' => '2020/03/22'],
          ['date' => '2020/03/23',	'ETF' => '2004',	'support' => '12',	'J-REIT' => '40'],
          ['date' => '2020/03/24',	'support' => '12'],
          ['date' => '2020/03/25',	'support' => '12'],
          ['date' => '2020/03/26',	'ETF' => '2004',	'support' => '12'],
          ['date' => '2020/03/27',	'support' => '12',	'J-REIT' => '40'],
          ['date' => '2020/03/28'],
          ['date' => '2020/03/29'],
          ['date' => '2020/03/30',	'ETF' => '2004',	'support' => '12',	'J-REIT' => '40'],
          ['date' => '2020/03/31',	'support' => '12',	'J-REIT' => '40'],
          ['date' => '2020/04/01',	'ETF' => '1202',	'support' => '12',	'J-REIT' => '20'],
          ['date' => '2020/04/02',	'ETF' => '1202',	'support' => '12',	'J-REIT' => '20'],
          ['date' => '2020/04/03',	'support' => '12',	'J-REIT' => '20'],
          ['date' => '2020/04/04'],
          ['date' => '2020/04/05'],
          ['date' => '2020/04/06',	'support' => '12'],
          ['date' => '2020/04/07',	'support' => '12'],
          ['date' => '2020/04/08',	'support' => '12',	'J-REIT' => '20'],
          ['date' => '2020/04/09',	'ETF' => '1202',	'support' => '12',	'J-REIT' => '20'],
          ['date' => '2020/04/10',	'ETF' => '1202',	'support' => '12',	'J-REIT' => '20'],
          ['date' => '2020/04/11'],
          ['date' => '2020/04/12'],
          ['date' => '2020/04/13',	'support' => '12'],
          ['date' => '2020/04/14',	'support' => '12'],
          ['date' => '2020/04/15',	'ETF' => '1202',	'support' => '12'],
          ['date' => '2020/04/16',	'ETF' => '1202',	'support' => '12'],
          ['date' => '2020/04/17',	'support' => '12'],
          ['date' => '2020/04/18'],
          ['date' => '2020/04/19'],
          ['date' => '2020/04/20',	'support' => '12'],
          ['date' => '2020/04/21',	'ETF' => '1202',	'support' => '12',	'J-REIT' => '20']
         ];

         // 登録
         foreach($gpifD as $gpif) {
           \App\GPIF::create($gpif);
         }
     }


}
