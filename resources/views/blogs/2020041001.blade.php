@extends('layouts.default')

@section('title', 'GPIFの買い入れについて')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/blog">更新ブログ一覧</a></li>
    <li class="breadcrumb-item">GPIFの買い入れについて</li>
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
  <h3>GPIFの買い入れについて</h3>
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


<div class="container mb-4" id="1st">
  <h5>日銀の買い入れについて</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">
      日銀の資産運用額はＸＸＸ。東京証券市場の上場株式総額がXXX円。
      株式市場のX%を日銀が保有していることになります。
    </p>
    <p>
      また、日銀がETFを購入する目的は「物価の安定を図ることを通じて国民経済の健全な発展に資すること」としています<a href="https://www.boj.or.jp/mopo/outline/qqe.htm/"></a>。
      そのため、株価が下がりすぎて企業が買収されたり資本調達に失敗することを嫌がる＝株価の安定を図るという図式に則り、
      株式を購入しています。
    </p>
    <p>
      日銀はETFの購入で株式市場に参入しています。
      日銀の購入するETFは以下の銘柄になっています（野村証券の公表しているもの）。
      これらの出来高を時間単位で見てみましょう。

      1306　TOPIX上場投信
      1321　日経225上場投信
      1591　JPX日経400ETF
      1480　企業価値ETF（設備・人材投資ETF枠）
      2518　日本株女性活躍ETF（設備・人材投資ETF枠）
      https://www.boj.or.jp/mopo/measures/mkt_ope/index.htm/

      野村の日銀オペ買い付け対象
      https://nextfunds.jp/semi/article1-3.html


      金融政策
      （https://www.boj.or.jp/mopo/measures/mkt_ope/index.htm/）
      オペレーション等
      ・国庫短期証券売買オペ
      ・指数連動型上場投資信託受益権等買入等


      指数連動型上場投資信託受益権（ETF）および不動産投資法人投資口（J-REIT）の買入結果
      https://www3.boj.or.jp/market/jp/menu_etf.htm

      オペレーション（日次公表分）
      https://www3.boj.or.jp/market/jp/menu_o.htm


      1306（時間足）と日銀の買い入れには相関性が見られませんでした。
      では米国指標(NYダウ30種)とはどうでしょうか。
    </p>
  </div>
</div>


<a>
  {{$json[0]->meigaraCode}}
  {{$json[1]->meigaraCode}}
</a>

@if (isset( $json ))
  <div class="container">
    <table class="table table-hover-responsive">
      <tr class="thead-dark">
        <th>指標</th>
        <th>日時</th>
        <th>始値</th>
        <th>終値</th>
        <th>高値</th>
        <th>安値</th>
        <th>取引高</th>
        <th>DOW前日比</th>
        <th>DOW前日比%</th>
        <th>GPIF</th>
      </tr>

      @foreach($json as $Data)
        @if ($Data->meigaraCode == "DJIA")
        @else
        @endif
        <tr class="success">
            <td class="warning">{{ $Data->meigaraCode }}</td>
            <td>{{ $Data->date }} {{ $Data->time }}</td>
            <td>{{ $Data->openingPrice }}</td>
            <td>{{ $Data->closingPrice }}</td>
            <td>{{ $Data->highPrice }}</td>
            <td>{{ $Data->lowPrice }}</td>
            <td>{{ $Data->volume }}</td>
            <td>{{ $Data->beforeRatio }}</td>
            <td>{{ $Data->beforeRatioP }}</td>
            <td>{{ $Data->ETF }}</td>
          </tr>
      @endforeach
    </table>
  </div>
@endif


@section('scripts')

@endsection

@endsection
