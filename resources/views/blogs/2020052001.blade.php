@extends('layouts.default')

@section('title', '今後のKOSPIについて')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/blog">更新ブログ一覧</a></li>
    <li class="breadcrumb-item">今後のKOSPIについて</li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>今後のKOSPIについて</h3>
</div>

<div class="container mb-4" >
  <div class="card card-body" >
    <a>目次<a>
    <a href="#ZERO" class="router-link-exact-active router-link-active" style="text-indent:1em;">はじめに</a>
    <a href="#1st" class="router-link-exact-active router-link-active" style="text-indent:1em;">韓国の借金について</a>
    <a href="#2nd" class="router-link-exact-active router-link-active" style="text-indent:1em;">投資をするべきか</a>
    <a href="#3rd" class="router-link-exact-active router-link-active" style="text-indent:1em;">何に投資するべきか</a>
    <a href="#4th" class="router-link-exact-active router-link-active" style="text-indent:1em;">いつ始めるべきか</a>
    <a href="#6th" class="router-link-exact-active router-link-active" style="text-indent:1em;">手段の選択</a>
    <a href="#7th" class="router-link-exact-active router-link-active" style="text-indent:1em;">証券会社の選択</a>
  </div>
</div>

<div class="container mb-4" id="ZERO">
  <h5>はじめに</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">注意書きです</p>
    <p>
      特定の国に対してどうこうの思想はありません。自分に利益があるかを判断しております。
    </p>
  </div>
</div>


<div class="container mb-4" id="1st">
  <h5>韓国の借金について</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">善でも悪でもありません。経済活動です。</p>
    <p>
      日本人は投資についての心理的なブレーキがかかっているというのが一般論ですので、まずは善悪についての所感を記載します。
      以下の<a href="https://ja.wikipedia.org/wiki/%E6%8A%95%E8%B3%87" target=”_blank”>wikipedia</a>からの引用をご覧ください。
    </p>
    <p class="my-0 border border-info">
      金融における投資：投資が必要となるのは、経済または経営主体が、自己資本に加えて、追加的な他人資本を調達することで、より大きな投資機会に投資が可能となるからである。（「"投資"」『フリー百科事典　ウィキペディア日本語版』より。最終更新 2020年2月26日 (水) 07:45）
    </p>
    <p>
      個人ではお金がたりない事業を達成するためにお金を集める、とのことです。
    </p>
    <p>
      治水などの公共事業もこれの仲間と考えれば国に所属するのも似たようなものですよね。税金という掛け金で政治家（官僚）に運用してもらう。パフォーマンスが悪ければ解雇する。
    </p>
    <p>
      こんなものに善も悪もないでしょう。
    </p>
  </div>
</div>

<div class="container mb-4" id="2nd">
  <h5>投資をするべきか</h5>
  <div style="padding-left: 1em;">
    <p class="my-2">
      現金の資本価値というのは減少します。資本価値を将来も維持しておくには投資するしかありません。
    </p>
    <p class="my-2">
      下の図を見てください。1989年から2018年ごろの推移情報をグラフ化しています。
    </p>
    <p>
      図①は消費者物価指数です。総務省が集計している物価(2015年を1とした比較)の遷移図です。
    </p>
    <p>
      物価は右肩上がりです。1989年=88.5ポイント,2018年=101.3ポイントでほぼ30年で<u>物価が101.3 / 88.5 = 1.14倍</u>になっています。
    </p>
    <p class="mt-2">
      図②は銀行金利の推移<a style="color:red;">（赤線）</a>と1989年に100万円を普通口座に預金した際の預金額の推移<a style="color:blue;">(青棒)</a>です。
    </p>
    <p>
      1989年に預金した1,000,000円は2018年に1,062,930円になったので<u>銀行に預け続けた場合1.06倍</u>になります。
    </p>
    <p>
      預金額の増加指数（②）を物価の増加指数（①）で割ると、1.06 / 1.14 = <u><a style="color:red;">0.93</a></u>となり、預金額が相対的に減少していることがわかります。
    </p>
    <p class="mt-2">
      図③は日経平均株価（年／終値）です。
    </p>
    <p>
      1989年の終値=38,916円と2018年の終値=20,015円を割ると、<u>20,015 / 38,916 =0.515倍</u>ですね。ほぼ半減しています。
    </p>
    <p class="my-2">
      ここで、<u><a style="color:red;">株価は上がり続けている</a></u>という事実が表示できれば<u><a style="color:red;">銀行預金では資金を失居続けるので投資するべきである</a></u>という結論をかけるのですがそううまくいきません。
    </p>

    <!-- 集計結果の表示 -->
    <p class="my-2">
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">集計したデータを表示／畳む</button>
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#GraphA" aria-expanded="true" aria-controls="GraphA">グラフを畳む／表示</button>
    </p>

    <div class="collapse" id="collapseExample">
      <div class="card card-body">
        <div class="bs-example">
          <div class="table-responsive">
            <!-- <table class="table table-bordered table-hover"> -->
            <table class="table table-sm table-hover">
              <a>表１_1989年からの遷移データ</a>
              <thead>
                <tr>
                  <th>年</th>
                  <th>消費者物価指数</th>
                  <th>預金利率</th>
                  <th>預金額</th>
                  <th>日経平均株価</th>
                </tr>
              </thead>
              <tbody>
                <tr><td>1989</td><td>88.5</td><td>0.428</td><td>1,000,000</td><td>38,916</td></tr>
                <tr><td>1990</td><td>91.2</td><td>1.581</td><td>1,004,280</td><td>23,849</td></tr>
                <tr><td>1991</td><td>94.3</td><td>1.832</td><td>1,020,155</td><td>22,984</td></tr>
                <tr><td>1992</td><td>95.8</td><td>0.559</td><td>1,038,845</td><td>16,925</td></tr>
                <tr><td>1993</td><td>97.1</td><td>0.259</td><td>1,044,653</td><td>17,417</td></tr>
                <tr><td>1994</td><td>97.7</td><td>0.22</td><td>1,047,357</td><td>19,723</td></tr>
                <tr><td>1995</td><td>97.6</td><td>0.165</td><td>1,049,661</td><td>19,868</td></tr>
                <tr><td>1996</td><td>97.7</td><td>0.1</td><td>1,051,395</td><td>19,361</td></tr>
                <tr><td>1997</td><td>99.5</td><td>0.1</td><td>1,052,446</td><td>15,259</td></tr>
                <tr><td>1998</td><td>100.1</td><td>0.1</td><td>1,053,499</td><td>13,842</td></tr>
                <tr><td>1999</td><td>99.8</td><td>0.069</td><td>1,054,552</td><td>18,934</td></tr>
                <tr><td>2000</td><td>99.1</td><td>0.068</td><td>1,055,284</td><td>13,786</td></tr>
                <tr><td>2001</td><td>98.4</td><td>0.038</td><td>1,056,005</td><td>10,543</td></tr>
                <tr><td>2002</td><td>97.5</td><td>0.008</td><td>1,056,411</td><td>8,579</td></tr>
                <tr><td>2003</td><td>97.2</td><td>0.003</td><td>1,056,497</td><td>10,677</td></tr>
                <tr><td>2004</td><td>97.2</td><td>0.001</td><td>1,056,524</td><td>11,489</td></tr>
                <tr><td>2005</td><td>96.9</td><td>0.001</td><td>1,056,535</td><td>16,111</td></tr>
                <tr><td>2006</td><td>97.2</td><td>0.045</td><td>1,056,545</td><td>17,226</td></tr>
                <tr><td>2007</td><td>97.2</td><td>0.198</td><td>1,057,021</td><td>15,308</td></tr>
                <tr><td>2008</td><td>98.6</td><td>0.185</td><td>1,059,114</td><td>8,860</td></tr>
                <tr><td>2009</td><td>97.2</td><td>0.039</td><td>1,061,075</td><td>10,546</td></tr>
                <tr><td>2010</td><td>96.5</td><td>0.029</td><td>1,061,494</td><td>10,229</td></tr>
                <tr><td>2011</td><td>96.3</td><td>0.02</td><td>1,061,802</td><td>8,455</td></tr>
                <tr><td>2012</td><td>96.2</td><td>0.02</td><td>1,062,014</td><td>10,395</td></tr>
                <tr><td>2013</td><td>96.6</td><td>0.02</td><td>1,062,226</td><td>16,291</td></tr>
                <tr><td>2014</td><td>99.2</td><td>0.02</td><td>1,062,439</td><td>17,451</td></tr>
                <tr><td>2015</td><td>100</td><td>0.02</td><td>1,062,651</td><td>19,034</td></tr>
                <tr><td>2016</td><td>99.9</td><td>0.005</td><td>1,062,864</td><td>19,114</td></tr>
                <tr><td>2017</td><td>100.4</td><td>0.001</td><td>1,062,920</td><td>22,765</td></tr>
                <tr><td>2018</td><td>101.3</td><td>0.001</td><td>1,062,931</td><td>20,015</td></tr>
                <tr><td>2019</td><td>ー</td><td>0.001</td><td>1,062,942</td><td>23,657</td></tr>
                <tr><td>2020</td><td>ー</td><td>0.001</td><td>1,062,952</td><td>19,085</td></tr>
              </tbody>
            </table>
          </div>
          <p></p>
        </div>
      </div>
    </div>
    <!-- 集計結果の表示 -->

    <div class="collapse show" id="GraphA">

      <div class="mt-3">
        <div class="img-fluid">
          <p>図①_消費者物価指数(2015年を基準値100とした推移)</p>
          <img src="{{ asset('images/消費者物価指数.png')}}" alt="①消費者物価指数" title="①消費者物価指数" id="Graph1"  class="border">
        </div>
      </div>

      <div class="mt-3">
        <div class="img-fluid">
          <p>図②_銀行預金額の推移(1989年に銀行に100万円を預金)</p>
          <img src="{{ asset('images/銀行預金金利の推移.png')}}"alt="②銀行預金金利の推移" title="②銀行預金金利の推移"  id="Graph2" class="border">
        </div>
      </div>

      <div class="mt-3">
        <div class="img-fluid">
          <p>図③_日経平均株価（年／終値）の推移</p>
          <img id="Graph3" src="{{ asset('images/日経平均株価（年／終値）の推移.png')}}" alt="③日経平均株価" title="③日経平均株価"   class="border" data-toggle="modal" data-target="#image_Modal" style="cursor:pointer" >
        </div>
      </div>

      <div class="modal fade" id="image_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <!-- モーダルウィンドウの縦表示位置を調整・画像を大きく見せる -->
        <div class="modal-dialog modal-lg modal-middle">
          <div class="modal-content">
            <div class="modal-body">
              <img src="{{ asset('images/日経平均株価（年／終値）の推移.png')}}" alt="baby-1151351_1920" class="aligncenter size-full wp-image-425"/>
            </div>
            <div class="modal-img_footer">
              <p>モーダル商品</p><!-- テキスト表示 -->
              <button type="button" class="btn btn-success" data-dismiss="modal">Close</button><!-- ボタンを取り付け -->
            </div>
          </div>
        </div>
      </div>

    </div>

    <p class="mt-3">見てもらいたいのが<a style="color:red;">〇</a>をつけたところで暴落が起き、何年かかけて回復するということです。</p>
    <p><u>ここで株を購入できてれば資金を増やせるということだけ認識しておいてください。</u></p>
    <p>
      1989年ってバブル期なので日本が絶好調のときですので、株を勧めるときのサンプルとしてはよろしくないですね。
      高騰しているときは買わない、暴落しているときに買うということで勘弁してください。
    </p>
  </div>

</div>

<div class="container mb-4" id="3rd">
  <h5>何に投資するべきか</h5>
  <div style="padding-left: 1em;">
    <p>判断がつかないうちは大手の株式(国内株or米国株)がお薦めです。</p>
    <p>このページでは株式を前提に話を進めています。</p>

    <p class="mt-2">投資の一覧（上から低リスクと思うもの）</p>
    <ul>
      <li>国債：国が発行する債券である国庫債券のこと</li>
      <li>社債：企業が発行する債券である債券のこと</li>
      <li>株式：企業のオーナー権を分割して出資金を集める際に発行する証明のこと</li>
      <li>外国為替証拠金取引(FX)：証拠金を元に通貨を交換すること</li>
      <li>上場投資信託(ETF)：投資信託会社に資金を預け運用してもらうこと</li>
      <li>不動産：不動産物件を購入し、家賃収入を得るまたは売却すること</li>
      <li>不動産投資信託(REIT)：不動投資信託会社に資金を預け運用してもらうこと</li>
      <li>金：金を購入すること</li>
      <li>仮想通過：仮想通過を購入すること</li>
      <li>先物取引：購入日に決められた値段で将来に売買する取引のこと</li>
    </ul>

    <p>各々の投資の収益にはキャピタルゲイン(売買差益)とインカムゲイン(配当収入)があったりなかったりします。</p>
    <p>下の一覧にまとめましたので見てみてもいいかもしれません。有無以外は概念程度の値です。</p>
    <p>なお、インカムゲインが高い＝リスクが高いと考えてください（なしのものは除く）。</p>

    <!-- 隠し行 -->
    <p  class="my-2">
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">各投資のキャピタルゲインとインカムゲイン</button>
    </p>
    <div class="collapse" id="collapseExample">
      <div class="card card-body">
        <div class="bs-example">
          <div class="table-responsive">
            <table class="table table-sm table-hover">
              <a>表２_投資種類とインカムゲイン</a>
              <thead>
                <tr>
                  <th>種類</th>
                  <th>インカムゲインの有無</th>
                  <th>インカムゲインの年利</th>
                </tr>
              </thead>
            <tbody>
              <tr><td>国債</td><td>利益あり</td><td>0.05％</td></tr>
              <tr><td>社債</td><td>利益あり</td><td>0.02%~2%</td></tr>
              <tr><td>株式</td><td>利益あり</td><td>配当金(0~5,6%)+株主優待(0~200%)</td></tr>
              <tr><td>FX</td><td>利益、負債あり</td><td>スワップポイント（-100%~50%）</td></tr>
              <tr><td>ETF</td><td>利益あり</td><td>0~2,3%</td></tr>
              <tr><td>不動産</td><td>利益あり</td><td>2~10%</td></tr>
              <tr><td>REIT</td><td>利益あり</td><td>3~16%</td></tr>
              <tr><td>金</td><td>なし</td><td>なし</td></tr>
              <tr><td>仮想通過</td><td>なし</td><td>なし</td></tr>
              <tr><td>先物取引</td><td>なし</td><td>なし</td></tr>
            </tbody>
        </table></div>
        <p></p></div>
      </div>
    </div>

    <p>私は生損保業界出身のため、定期的に業界周辺の株価やニュースを趣味でチェックしています。</p>
    <p>そのため、その他業界（建築・飲食etc）などより生損保業界の株価の値動きが判断しやすいです。</p>
    <p>
      そのため、各個人でそういった業界に投資するのがBestなのですが、
      投資対象として魅力を感じない場合は当然別業界に投資しましょう。
      私も生損保業界の株なんて買ったことありません。
    </p>
    <p>
      はじめのうちは国に守られている会社・業界の株をお薦めしています。
      以前<a href=https://stocks.finance.yahoo.co.jp/stocks/detail/?code=7203.T target="_blank" >
        トヨタ自動車株(7203)</a>
      を保持していたのですが、最大の理由が自民党により優遇を受けている、
      と判断したためです。以下の資料に<u>水素を使ったエネファームが普及し、水素燃料電池自動車も実用化する。
      </u>と記載があります。
      水素自動車が実現する＝トヨタ社にメリットが大きい、という判断をしました。
    </p>
    <p>
      （<a href=https://www.jimin.jp/news/policy/125398.html target="_blank" >国家戦略本部「2030 年の日本」検討・対策プロジェクト</a>）。
    </p>
    <!-- <p>
      米国でいえばGAFA(GOOGLE、AMAZON、FACEBOOK、APPLE)が保護されています。
      5Gの受注に向けて米国は中国と経済戦争をし始めました。
      記入当日2020/4/2の断面でNYSE(ニューヨーク証券取引所/NewYorkStockExchange)の時価総額$28,528,761($M)のうち?%(GOOGLE、AMAZON、FACEBOOK、APPLE)を占めているのでこの産業を保護するのは当然でしょう。
      https://www.nyse.com/market-cap
      (別記載：米国がGAFA(GOOGLE、AMAZON、FACEBOOK、APPLE)を保護する理由)

      ここの株価は落ちたら上がりますし、大統領が変わらない限り上がり続けることでしょう。
      (別記載：株価は大統領により左右される)
    </p> -->
  </div>
</div>

<div class="container mb-4" id="4th">
  <h5>いつ始めるべきか</h5>
  <div style="padding-left: 1em;">
    <p>
      金融危機が起きている時がお薦めです（<a href="#Graph3">③の暴落</a>が落ちているとき）。
      基本的には恐慌後の株価というのは回復します。
      株は売り払われることで値下がりしますが、恐慌が去るとみんなでこぞって買い戻します。
      具体的には、別で<a href="#">チャートの読み方（の基本）</a>を書きますのでそれを読んで考えてもらうとよいでしょう。
    </p>
  </div>
</div>


<div class="container mb-4" id="6th">
  <h5>手段の選択</h5>
  <div style="padding-left: 1em;">
    <p>
      株式を購入するための選択肢としては以下がありますが、
      <ul>
        <li>店頭証券会社</li>
        <li>ネット証券会社</li>
      </ul>
      よほどの事情(対人関係などの経済とは別の理由)がない限り店頭証券会社にはメリットがないのでネット証券会社で口座を開設しましょう。
    </p>
  </div>
</div>

<div class="container mb-4" id="7th">
  <h5>証券会社の選択</h5>
  <div style="padding-left: 1em;">
    <p>
      ネット証券会社も十数社存在します。
      どの会社を選択するかは基本的に以下が判断材料になります。
    </p>
    <ul>
      <li>手数料</li>
      <li>IPO取扱数</li>
      <li>取引ツール</li>
      <li>投資情報</li>
      <li>取扱商品</li>
      <li>口座開設によるキャンペーン</li>
      <li>グループ会社のサービス</li>
    </ul>
    <p>
      私は楽天グループでクレカ・銀行を固めているので楽天証券を使用していますが、評判はなかなかです。
    </p>
      <p>
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">証券会社一覧（2020年4月4日時点）</button>
      </p>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
          <div class="bs-example">
            <div class="table-responsive">
              <ul>
                <li>あ</li>
                <li>い</li>
                <li>う</li>
                <li>え</li>
                <li>お</li>
                <li>か</li>
                <li>き</li>
              </ul>
            </div>
          <p></p></div>
        </div>
      </div>

    </p>
    <p>
      特殊な条件を除いて<a href="https://www.sbisec.co.jp/ETGate">SBI証券<a>、<a href="https://www.rakuten-sec.co.jp/">楽天証券</a>、<a href="https://www.matsui.co.jp/">松井証券</a>（左からお薦め）のいずれかを選びましょう。
      単純に国内最大手事業者ですし、手数料が安いです。
    </p>
    <p>
      口座を開設する際はおおむねキャンペーンが展開されているので、公式サイトでの開設で何もキャンペーンが展開されていないようでしたら適当なサイト（<a href="https://xn--t8j4aa4nmisa11bucb6928e1fhgj6jwf0b.com/">サンプル：証券会社比較.com</a>）に行って小銭をもらいましょう。
    </p>
    <p>
      当サイトでもグレードアップが進んで広告バナーが付いたら口座開設のリンクを張れるようにする予定です。
    </p>
  </div>
</div>

@section('scripts')

@endsection

@endsection
