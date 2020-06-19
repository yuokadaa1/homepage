@extends('layouts.default')

@section('title', '機関投資家の挙動について')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/blog">更新ブログ一覧</a></li>
    <li class="breadcrumb-item">機関投資家の基本について</li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>機関投資家の挙動について</h3>
</div>

<div class="container mb-4" >
  <div class="w-50 card card-body" >
    <a>目次<a>
    <a href="#ZERO" class="router-link-exact-active router-link-active" style="text-indent:1em;">機関投資家とは何か</a>
    <a href="#1st" class="router-link-exact-active router-link-active" style="text-indent:1em;">機関投資家による売買</a>
    <a href="#2nd" class="router-link-exact-active router-link-active" style="text-indent:1em;">機関投資家の義務</a>
    <a href="#3rd" class="router-link-exact-active router-link-active" style="text-indent:1em;">金利が及ぼす影響について</a>
    <a href="#4th" class="router-link-exact-active router-link-active" style="text-indent:1em;">株価について</a>
  </div>
</div>

<div class="container mb-4" id="ZERO">
  <h5>機関投資家とは何か</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">機関投資家とは大口の売買が可能な組織を指します。</p>
    <p>相場情報を確認するときに欠いてはいけないのがクジラにも例えられる機関投資家の挙動です。</p>
    <p>個人投資家は彼らの起こす波によって翻弄される小魚ということですね。</p>
    <p>そんな機関投資家とは何者であるかということを記載していきます。</p>

  </div>
</div>


<div class="container mb-4" id="ZERO">
  <h5>機関投資家とは誰か</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">機関投資家</p>
    <div class="card " >
      <p>
        機関投資家とは、生命保険会社、損害保険会社、信託銀行、普通銀行、信用金庫、年金基金、共済組合、農協、政府系金融機関など、大量の資金を使って株式や債券で運用を行う大口投資家のことをいいます機関投資家とは、生命保険会社、損害保険会社、信託銀行、普通銀行、信用金庫、年金基金、共済組合、農協、政府系金融機関など、大量の資金を使って株式や債券で運用を行う大口投資家のことをいいます
      </p>
    </div>

    <p class="mt-2">日本最大の5頭のクジラとして以下が挙げられます。</p>
    <ul>
      <li>日本銀行：31兆円</li>
      <li>年金積立金管理運用独立行政法人（GPIF）：169兆</li>
      <li>共済年金（3共済※）：30兆4,649億円</li>
      <li>ゆうちょ銀行：135兆1,984億円</li>
      <li>かんぽ生命保険：55兆8,705億円</li>
    </ul>
    <p>東京証券市場（1部+2部）の上場株式総額が559兆円。日銀以外は日本国債を購入したり、外国株式・外国債券にも投資するので単純な比較はできないのですが、彼らの運用額だけで400兆円近くになります。</p>
    <p>比率としては日本の株式・債権が高いですが規模の大きさだけでその影響力がわかると思います。</p>
    <p>日本銀行は2020年3月末までの累計</p>
    <p>GPIFは<a href="https://www.gpif.go.jp/operation/the-latest-results.html">2019年度第３四半期(2019年12月)の期運用状況（速報）</a>より</p>
    <p><a href="https://www.kkr.or.jp/shikin/operation/investment_results.html">国家公務員共済組合連合会</a>、<a href="https://www.chikyoren.or.jp/sikin/joukyo.html">地方公務員共済組合連合会</a>、<a href="https://www.shigakukyosai.jp/announce/index.html">日本私立学校振興・共済事業団</a>(それぞれ6兆9,516億円+23兆1,458億円+3兆6,755億円)は2019年の決算報告より</p>
    <p>ゆうちょ銀行<a href="https://www.jp-bank.japanpost.jp/ir/financial/ir_fnc_kessan.html">2020年の決算報告</as>有価証券保有額より</p>
    <p>かんぽ生命<a href="https://www.jp-life.japanpost.jp/IR/library/meeting.html">2020年の決算報告書</a>有価証券保有額より</p>

  </div>
</div>

<div class="container mb-4" id="ZERO">
  <h5>機関投資家のルール</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">機関投資家の利用方法</p>
    <p>機関投資家と個人投資家の違いは書くときりがないですが、基本的に一方的に機関投資家が有利です。</p>
    <p>巨額の資本と有利な決済システム、会社代表者にインタビューが可能といった情報量の多さがあり、個人投資家には不可能な利点があります。</p>
    <p>個人投資家が勝っている点は、決済報告が不要＝決まったタイミングで利益を出している必要がないということだけでしょう。</p>
    <p>※彼らは出資者に対し、何にいくら投資し幾ら儲けたかを報告する義務があります。</p>
    <p>そのため、機関投資家の作り出した流れに個人投資家が逆らうことは不可能です。</p>
    <p>ということは機関投資家の作り出した流れに乗り彼らより少しだけ儲けを生み出すのが一つのベターな作戦になります。</p>
    <p>というわけでここでは彼らの生態系を羅列してみましょう。</p>
      <ul>
        <li>損失を許さ（れ）ない。</li>
        <li>頻繁に売買を行わない。</li>
        <li>大型株を好む。</li>
      </ul>
    <p>彼らが保有している株はプロが安定志向で購入したものになりますので、長期的に上昇が見込める銘柄となります。</p>
    <p>そんな彼らの購入している株を実際に見てみましょう。</p>

  </div>
</div>

<div class="container mb-4" id="ZERO">
  <h5>機関投資家の購入株</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">機関投資家の購入株を見てみましょう。</p>
    <p>ここでは保有株が公開されている共済年金（地方公務員共済組合連合会）を参照してみましょう。</p>
    <p>保有時価総額のTOP20を抽出しました。</p>
    <p>平均取得単価を記載していますので、この値より下がったら買いを検討してもいいでしょう。</p>
    <div class="w-75 mx-auto table-responsive text-right">
      <div class="card">
        <table class="table table-sm table-hover">
          <thead>
            <tr class="thead-dark">
              <th>証券コード</th><th>銘柄名</th><th>平均取得単価</th><th>保有数量</th><th>時価総額</th>
            </tr>
          </thead>
          <tbody>
            <tr><td>7203</td><td>トヨタ自動車</td><td>6,607</td><td>22,644,700</td><td>149,611,852,900</td></tr>
            <tr><td>9984</td><td>ソフトバンクG</td><td>10,767</td><td>9,931,000</td><td>106,927,063,800</td></tr>
            <tr><td>8306</td><td>三菱ＵＦＪFG</td><td>561</td><td>177,814,100</td><td>99,753,020,400</td></tr>
            <tr><td>9432</td><td>日本電信電話</td><td>4,798</td><td>18,429,200</td><td>88,422,769,600</td></tr>
            <tr><td>4502</td><td>武田薬品工業</td><td>4,611</td><td>18,431,600</td><td>84,979,449,600</td></tr>
            <tr><td>8316</td><td>三井住友FG</td><td>3,961</td><td>20,624,400</td><td>81,692,729,900</td></tr>
            <tr><td>6758</td><td>ソニー</td><td>4,665</td><td>15,224,000</td><td>71,019,500,000</td></tr>
            <tr><td>6861</td><td>キーエンス</td><td>69,070</td><td>1,006,000</td><td>69,484,120,000</td></tr>
            <tr><td>8058</td><td>三菱商事</td><td>3,137</td><td>21,841,300</td><td>68,515,496,600</td></tr>
            <tr><td>6981</td><td>村田製作所</td><td>5,559</td><td>11,033,700</td><td>61,333,178,400</td></tr>
            <tr><td>7267</td><td>本田技研工業</td><td>3,023</td><td>20,130,400</td><td>60,853,916,400</td></tr>
            <tr><td>9433</td><td>ＫＤＤＩ</td><td>2,437</td><td>20,291,800</td><td>49,445,333,000</td></tr>
            <tr><td>6098</td><td>リクルートHD</td><td>3,174</td><td>15,322,600</td><td>48,641,126,600</td></tr>
            <tr><td>4452</td><td>花王</td><td>8,718</td><td>5,502,500</td><td>47,970,795,000</td></tr>
            <tr><td>2914</td><td>日本たばこ産業</td><td>2,745</td><td>17,301,800</td><td>47,493,441,000</td></tr>
            <tr><td>9020</td><td>東日本旅客鉄道</td><td>10,755</td><td>4,313,500</td><td>46,391,295,000</td></tr>
            <tr><td>6501</td><td>日立製作所</td><td>3,625</td><td>12,794,200</td><td>46,378,975,000</td></tr>
            <tr><td>8766</td><td>東京海上HD</td><td>5,452</td><td>8,169,100</td><td>44,537,843,200</td></tr>
            <tr><td>9022</td><td>東海旅客鉄道</td><td>25,780</td><td>1,725,000</td><td>44,470,451,000</td></tr>
            <tr><td>4063</td><td>信越化学工業</td><td>9,380</td><td>4,692,200</td><td>44,013,426,000</td></tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <div class="mt-2">
    <p>
      他にもSOMPOアセットマネジメント社では<a href="https://www.sompo-am.co.jp/resources/4d/4d404bbec5c7de60e2d42b53d8df1af8dd3df5b7.pdf">次世代⾦融テクノロジー株式ファンドで組入銘柄の紹介</a>などしています。
    </p>
    <p>購入銘柄に迷うことがあればこういったファンドの紹介も参照してみてください。</p>
  </div>

</div>



@section('scripts')

@endsection

@endsection
