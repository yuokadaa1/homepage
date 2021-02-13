@extends('layouts.default')

@section('title', '適当ブログ一覧')

@section('content')
<h3>更新ブログ一覧</h3>
<p><span class="label label-danger">HOME</span> -> 更新ブログ一覧</p>

  <div class="container">
    <div class="form-group">
      <p class="text-center bg-info">登録する写真の一番目はサムネイル。</p>
    </div>
  </div>

  <div class="container">
    <div class="form-group">
      <ul>

        <li><a href={{ url("/blog/2020032301") }}>2020/03/21　初心者の投資について</a></li>
        <li><a href={{ url("/blog/2020040601") }}>2020/04/06　各国市場のオープン時刻について</a></li>
        <li><a href={{ url("/blog/2020041001") }}>2020/04/10　日銀のETF買い入れについて</a></li>
        <li><a href={{ url("/blog/2020052701") }}>2020/05/27　FX証拠金の計算</a></li>
        <li><a href={{ url("/blog/2020061301") }}>2020/06/13　円高・円安について</a></li>
        <li><a href={{ url("/blog/2020061601") }}>2020/06/16　機関投資家の基本について</a></li>
        <li><a href={{ url("/blog/2020061801") }}>2020/06/18　寄り付きを狙う</a></li>
        <li><a href={{ url("/blog/2020061901") }}>2020/06/19　決算資料の読み方</a></li>
        <li><a href={{ url("/blog/2020062201") }}>2020/06/22　決算書指標計算シミュレータ</a></li>
        <li><a href={{ url("/blog/2020062301") }}>2020/06/23　流れの変わり目について</a></li>
        <li><a href={{ url("/blog/2020062601") }}>2020/06/26　通貨の相関について</a></li>
        <li><a href={{ url("/blog/2020071401") }}>2020/07/14　エリオット波動とフィボナッチ比率</a></li>
        <li><a href={{ url("/blog/2021020101") }}>2021/02/01　日本株式のドル価</a></li>

      </ul>
    </div>
  </div>


@section('scripts')
    <!-- <script src="/js/starter-template.js"></script> -->
@endsection

@endsection
