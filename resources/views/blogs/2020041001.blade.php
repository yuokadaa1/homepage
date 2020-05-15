@extends('layouts.default')

@section('title', '日銀のETF買い入れについて')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/blog">更新ブログ一覧</a></li>
    <li class="breadcrumb-item">日銀のETF買い入れについて</li>
  </ol>
</nav>

<!-- python起動のテスト -->
<!-- <div class="container mb-4">
  <form action="{{ url('/python') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
    @csrf
      <input type="submit" name="submit" value="pythonの起動">
  </form>
</div> -->



<div class="container mb-4">
  <h3>日銀のETF買い入れについて</h3>
</div>


<div class="container mb-4" id="1st">
  <h5>日銀の買い入れと個人投資家の関係</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">
      この事象が自分に利するかについて記載します。
    </p>
    <p class="my-2">
      当然ですが、株価の予測は大変難しいです。
      何か大きな経済ニュースが発生してもその事象は織り込み済として株価に反映されないことが多々あります。
      その中で<u>日銀のETF買い</u>は比較的簡単に予測がつきやすい事象として扱われています。
      一般的には以下２つが言われています。
      <ul>
        <li>アメリカの株価が下落した翌日</li>
        <li>TOPIX（東証株価指数）が午前中に0.5％下落</li>
      </ul>
      その事象が本当なのか、この情報をもとに個人投資家として資産を増やすことが可能なのか確認します。
    </p>
  </div>
</div>

<div class="container mb-4" id="2nd">
  <h5>日銀の買い入れの目的・公式見解</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">
      日銀がETFを購入する理念は<a href="https://www.boj.or.jp/mopo/outline/qqe.htm/">日本銀行HP／金融政策</a>のページに記載されています。
    </p>
    <p class="my-2">
      曰く「<u>物価の安定を図ることを通じて国民経済の健全な発展に資すること</u>」とのことです。
      物価と株価の関係は<a href="">別ページ</a>に記載していますが、要は株価の上昇->金利の低下という式を通じて金利を下げようとするものです。金利が下がると借金の利息が下がって借金してくれる人が増え消費が増大するというもので、<a class="text-danger">株価の上昇->金利の低下->借金の増加->消費活動の増加->好景気化</a>の式を目指しているというわけですね。
    </p>
  </div>
</div>

<div class="container mb-4" id="3rd">
  <h5>日銀の買い入れの実態・規模</h5>
  <div  style="padding-left: 1em;">
    <p class="mt-2">
      日銀の買入総額は31兆円(2020年3月末までの累計)。東京証券市場（1部+2部）の上場株式総額が559兆円。
    </p>
    <p>
      日銀は買い入れたETFをほとんど売却しないといわれているので東京証券市場の5.6%を日銀が保有していることになります。
    </p>

    <div class="mt-3">
      <div class="img-fluid">
        <p>図①_日銀の買入額</p>
        <img src="{{ asset('images/日銀の買入額.png')}}" alt="①日銀の買入額" title="日銀の買入額" id="Graph1"  class="border">
      </div>
    </div>

    <p class="my-2">
      購入するETFは購入する証券会社により変わります。以下の銘柄になっています
    </p>
    <p >
      野村証券は以下（<a href="https://nextfunds.jp/semi/article1-3.html">「日銀のETF買い入れについて」</a>より）。
      <ul>
        <li>1306　TOPIX上場投信</li>
        <li>1321　日経225上場投信</li>
        <li>1591　JPX日経400ETF</li>
        <li>1480　企業価値ETF（設備・人材投資ETF枠）</li>
        <li>2518　日本株女性活躍ETF（設備・人材投資ETF枠）</li>
      </ul>
    </p>
    <p>
      日興証券は以下（<a href="http://localhost:8000/blog/2020041001">「ETFのキホン」</a>より）。
      <ul>
        <li>1308 - 上場インデックスファンドＴＯＰＩＸ</li>
        <li>1578 - 上場インデックスファンド日経２２５（ミニ）</li>
        <li>1592 - 上場インデックスファンドJPX日経インデックス400</li>
        <li>1481 - 上場インデックスファンド日本経済貢献株</li>
      </ul>
    </p>

  </div>
</div>

<div class="container mb-4" id="3rd">
  <h5>日銀の買入タイミングの検証</h5>
  <div  style="padding-left: 1em;">
    <p>
      検証として、前日夜間にダウ平均株価が下がり
    </p>

    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#GraphA" aria-expanded="true" aria-controls="GraphA">ダウ平均と1306の株価を畳む／表示</button>

    <div class="collapse show" id="GraphA">
      <div class="card card-body">

        <div class="bs-example">
          @if (isset( $json ))
            <div class="container">
              <table class="table table-hover-responsive">

                <tr class="thead-dark">
                  <th>指標</th>
                  <th>日時</th>
                  <th>始値</th>
                  <th>終値</th>
                  <!-- <th>高値</th> -->
                  <!-- <th>安値</th> -->
                  <th>取引高</th>
                  <th>日足始値</th>
                  <th>前日終値</th>
                  <th>DOW前日比</th>
                  <th>DOW前日比%</th>
                  <th>ETF購入(億円)</th>
                </tr>

                @foreach($json as $Data)
                  @if ($Data->meigaraCode == "DJIA")
                    <!-- <tr class="thead-light">
                      <th>{{ $Data->meigaraCode }}</th>
                      <th>{{ $Data->date }} {{ $Data->time }}</th>
                      <th>{{ $Data->openingPrice }}</th>
                      <th>{{ $Data->closingPrice }}</th> -->
                      <!-- <th>{{ $Data->highPrice }}</th>
                      <th>{{ $Data->lowPrice }}</th> -->
                      <!-- <th>{{ $Data->volume }}</th>
                      <th>{{ $Data->todayOpening }}</th>
                      <th>{{ $Data->amClosingPrice }}</th>
                      <th>{{ $Data->beforeRatio }}</th>
                      @if ($Data->beforeRatioP < 0)
                        <th class="text-success">{{ $Data->beforeRatioP }}</th>
                      @else
                        <th>{{ $Data->beforeRatioP }}</th>
                      @endif
                      <th>{{ $Data->BOJETF }}</th>
                    <tr> -->
                  @else
                    @if ($Data->time == "11:00:00")
                    <tr >
                      <td>{{ $Data->meigaraCode }}</td>
                      <td>{{ $Data->date }} {{ $Data->time }}</td>
                      @if ($Data->time == "09:00:00" and $Data->BOJETF <> "")
                            <td class="text-success">{{ $Data->openingPrice }}</td>
                      @else
                        <td>{{ $Data->openingPrice }}</td>
                      @endif
                      @if ($Data->todayOpening  + 10 < $Data->closingPrice and $Data->BOJETF <> "")
                        <td class="text-danger">{{ $Data->closingPrice }}</td>
                      @else
                        <td>{{ $Data->closingPrice }}</td>
                      @endif
                      <!-- @if ($Data->todayOpening  + 10 < $Data->highPrice and $Data->BOJETF <> "")
                        <td class="text-danger">{{ $Data->highPrice }}</td>
                      @else
                        <td>{{ $Data->highPrice }}</td>
                      @endif
                      <td>{{ $Data->lowPrice }}</td> -->
                      <td>{{ $Data->volume }}</td>
                      <td>{{ $Data->todayOpening }}</td>
                      <td>{{ $Data->lastClosing }}</td>
                      <td>{{ $Data->beforeRatio }}</td>
                      <td>{{ $Data->beforeRatioP }}</td>
                      <td >{{ $Data->BOJETF }}</td>
                    
                    </tr>
                    @endif
                  @endif

                @endforeach
              </table>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container mb-4" id="ZERO">
  <h5>GPIFの買い入れについて</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">運用資産は2019年6月末で159兆円2,133億円</p>
    <p>
      GPIFの日本株の保有額で37兆7,642億円。東証1部の時価総額が約584兆円であることを考えると、GPIFは日本株の約6%強を保有している計算になる。 (いずれも2019年6月末時点)
    </p>
    <p>
      日銀は、アベノミクス以降の金融緩和策で日本株のETFを年間6兆円ペースで買い始めた。日本株保有額は28兆円強 (2019年3月末時点) に達しており、日本株の約5%弱を保有する計算になる。
    </p>
  </div>
</div>



@section('scripts')

@endsection

@endsection
