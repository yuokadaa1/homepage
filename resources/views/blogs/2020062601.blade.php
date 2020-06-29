@extends('layouts.default')

@section('title', '通貨の相関について')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/blog">更新ブログ一覧</a></li>
    <li class="breadcrumb-item">通貨の相関について</li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>通貨の相関について</h3>
</div>

<div class="container mb-4" >
  <div class="w-50 card card-body" >
    <a>目次<a>
    <a href="#ZERO" class="router-link-exact-active router-link-active" style="text-indent:1em;">通貨の相関について</a>
    <a href="#1st" class="router-link-exact-active router-link-active" style="text-indent:1em;">×決算資料の参照方法</a>
    <a href="#2nd" class="router-link-exact-active router-link-active" style="text-indent:1em;">×決算資料の読み方</a>
    <a href="#3rd" class="router-link-exact-active router-link-active" style="text-indent:1em;">×貸借貸借表について</a>
    <a href="#4th" class="router-link-exact-active router-link-active" style="text-indent:1em;">×貸借対照表の読み方-具体的に</a>
  </div>
</div>

<div class="container mb-4" id="ZERO">
  <h5>通貨の相関について</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">通貨には相関性があります。</p>
    <p>通貨の強弱を語るときには必ず相手がいます。</p>
    <p>USDに対してJPYの強弱が存在し、EUR(ユーロ)やGBP(イギリスポンド)、AUD(オーストラリアドル)が存在します。</p>
    <p>仮に全ての通貨に対してUSD高になった際、JPY/EURやEUR/GBPがどう動くかを記載します。</p>

  </div>
</div>

<div class="container mb-4" id="1st">
  <h5>通貨の相関図を見る</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">他サイト様の結果を確認する。</p>
    <p>下に<a href="https://currency-strength.com/"><u>© Currency Strength Chart</u></a>様の通貨の強弱図があります。</p>
    <p>他にはOANDA Japanの公開ている<a href="https://www.oanda.jp/lab-education/oanda_lab/oanda_rab/currency_power_balance/">通貨の強弱チャート</a>もあります。見やすいものを探して見ましょう。</p>

    <div class="w-75 embed-responsive embed-responsive-16by9">
      <iframe
        class="embed-responsive-item"
        src="https://currency-strength.com/"
        id="inline-frame"
        allowfullscreen>
      </iframe>
    </div>

  </div>
</div>

<div class="container mb-4" id="1st">
  <h5>通貨の相関図を見る</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">通貨強弱トレードについて</p>
    <p>上で挙げた通貨の強弱を利用したトレード手法を記載します。</p>
    <p><u>通貨強弱トレード</u>と言われています。</p>
    <p>手法的には以下３パターンから選択します。</p>
    <ul>
      <li>通貨の強弱に基づき順張りをするか</li>
      <li>通貨の強弱に基づき逆張りをするか</li>
      <li>通貨の強弱に基づきボックス相場とみなしてスキャルピングするか</li>
    </ul>

  </div>
</div>

<div class="container mb-4" id="1st">
  <h5>通貨の選択方法</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">通貨強弱トレードについて</p>
    <p>上で挙げた通貨の強弱を利用したトレード手法を記載します。</p>
    <p><u>通貨強弱トレード</u>と言われています。</p>
    <p>手法的には以下３パターンから選択します。</p>
    <ul>
      <li>通貨の強弱に基づき順張りをするか</li>
      <li>通貨の強弱に基づき逆張りをするか</li>
      <li>通貨の強弱に基づきボックス相場とみなしてスキャルピングするか</li>
    </ul>

  </div>
</div>


@section('scripts')

@endsection

@endsection
