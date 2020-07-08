@extends('layouts.default')

@section('title', '寄り付きを狙う')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/blog">更新ブログ一覧</a></li>
    <li class="breadcrumb-item">寄り付きを狙う</li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>寄り付きを狙う</h3>
</div>

<div class="container mb-4" >
  <div class="w-50 card card-body" >
    <a>目次<a>
    <a href="#ZERO" class="router-link-exact-active router-link-active" style="text-indent:1em;">寄り付きとは何か</a>
    <a href="#1st" class="router-link-exact-active router-link-active" style="text-indent:1em;">機関投資家による売買</a>
    <a href="#2nd" class="router-link-exact-active router-link-active" style="text-indent:1em;">機関投資家の義務</a>
    <a href="#3rd" class="router-link-exact-active router-link-active" style="text-indent:1em;">金利が及ぼす影響について</a>
    <a href="#4th" class="router-link-exact-active router-link-active" style="text-indent:1em;">株価について</a>
  </div>
</div>

<div class="container mb-4" id="ZERO">
  <h5>寄り付きとは何か</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">寄り付きとは</p>
    <p>寄り付きとは前場／後場それぞれで最初についた取引の値段のことを言います。</p>
    <p>逆に前場／後場で終わりについた値段を引けと言います。</p>
    <p>また、寄り付きの値段を略して寄り値と呼ばれています。午前の寄り値はその日の始値です。</p>
    <p>これを個人投資家がいかに利用するかを記載します。</p>

  </div>
</div>


<div class="container mb-4" id="#1st">
  <h5>データの確認</h5>
  <div  style="padding-left: 1em;">

    <p class="mt-2">以下、グラフ化したので見てみましょう。</p>
    <p>ダウ平均日足、トヨタ自動車（7203）の日足・分足をくっつけたグラフになっています。</p>
    <p>7203は前日の日足を15:00、09:00~09:30までの分足、当日の日足を15:00の位置に配置しています。</p>

    <div class="container-fluid">

      <h6 class="mt-2">2020/06/16(火)～2020/06/19(金)</h6>
      <div class="row">
        <img src="{{ asset('images/2020061801/2020061801_01_20200616.png')}}" id="graph1" class="border border-danger col-sm-12 col-md-6 col-lg-6">
        <img src="{{ asset('images/2020061801/2020061801_02_20200617.png')}}" id="graph2" class="col-sm-12 col-md-6 col-lg-6">
      </div>
      <div class="row">
        <img src="{{ asset('images/2020061801/2020061801_03_20200618.png')}}" id="graph3" class="col-sm-12 col-md-6 col-lg-6">
        <img src="{{ asset('images/2020061801/2020061801_04_20200619.png')}}" id="graph4" class="col-sm-12 col-md-6 col-lg-6">
      </div>

      <h6 class="mt-2">2020/06/22(月)～2020/06/26(金)</h6>
      <div class="row">
        <img src="{{ asset('images/2020061801/2020061801_05_20200622.png')}}" id="graph5" class="col-sm-12 col-md-6 col-lg-6">
        <img src="{{ asset('images/2020061801/2020061801_06_20200623.png')}}" id="graph6" class="col-sm-12 col-md-6 col-lg-6">
      </div>
      <div class="row">
        <img src="{{ asset('images/2020061801/2020061801_07_20200624.png')}}" id="graph7" class="col-sm-12 col-md-6 col-lg-6">
        <img src="{{ asset('images/2020061801/2020061801_08_20200625.png')}}" id="graph8" class="border border-primary col-sm-12 col-md-6 col-lg-6">
      </div>
      <div class="row">
        <img src="{{ asset('images/2020061801/2020061801_09_20200626.png')}}" id="graph9" class="col-sm-12 col-md-6 col-lg-6">
      </div>

      <h6 class="mt-2">2020/06/29(月)～2020/07/03(金)</h6>
      <div class="row">
        <img src="{{ asset('images/2020061801/2020061801_10_20200629.png')}}" id="graph10" class="border border-primary col-sm-12 col-md-6 col-lg-6">
        <img src="{{ asset('images/2020061801/2020061801_11_20200630.png')}}" id="graph11" class="border border-danger col-sm-12 col-md-6 col-lg-6">
      </div>
      <div class="row">
        <img src="{{ asset('images/2020061801/2020061801_12_20200701.png')}}" id="graph12" class="col-sm-12 col-md-6 col-lg-6">
        <img src="{{ asset('images/2020061801/2020061801_13_20200702.png')}}" id="graph13" class="col-sm-12 col-md-6 col-lg-6">
      </div>
      <div class="row">
        <img src="{{ asset('images/2020061801/2020061801_14_20200703.png')}}" id="graph14" class="col-sm-12 col-md-6 col-lg-6">
      </div>

    </div>

  </div>
</div>


<div class="container mb-4" id="1st">
  <h5>簡単な確認</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">詳細を見る前に簡単に見ていきます。</p>
    <p>前日のDow平均の下落に付き合って株価が下落する確率</p>
    <p>Dowが下落した日数:8、Dowが下落しかつ7203が下落した日数：4</p>
    <p>Dowが上昇した日数:6、Dowが下落しかつ7203が下落した日数：3</p>
    <p>Dowが下落し7203の30分以内が当日の安値:3</p>
    <p>Dowが上昇し7203の30分以内が当日の高値:2</p>
    <p>単純に、前日のDowを見たからと言って方向性が決まるわけではありませんでした。</p>

  </div>
</div>


<div class="container mb-4" id="1st">
  <h5>寄り値を利用したトレード手法</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">ギャップアップ(GU)・ギャップダウン(GD)を狙う</p>
    <p>GU/GDとは、当日始値が前日終値より（かなり）高い/安い状態を指します。</p>
    <p>手法的にはGU/GDを追いかけて順張り、GU=天井、GD=底と見做して逆張りのどちらかとなります。</p>
    <p>基本的にはGU/GDを追いかけるのが一般的です。</p>
    <p>では、GU/GDを起こしている日ですが、集計期間の株価の平均（(始値+終値) / 集計数 / 2）が6,850円なので1%の68円動いていればGU/GDとして考えると、</p>
    <p>GU:6/16,6/30、GD:6/25,6/29が該当します。</p>
    <p>GU=6/16:GUと同方向に日足が伸びる</p>
    <p>GU=6/30:GUと逆方向に日足が伸びる</p>
    <p>GD=6/25:GDと同方向に日足が伸びる</p>
    <p>GD=6/29:日足はどちらにも伸びない</p>

  </div>
</div>

<div class="container mb-4" id="1st">
  <h5>結論</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">使えません</p>
    <p>サンプルがよくないのか、GU/GDの基準が甘いのか、かはわかりませんが、</p>
    <p>方向性は特に示されませんでした。</p>
    <p>これなら、前日大きく下げた日の締め時間間際に買う、の方が勝率が高そうです。</p>
    <p>というわけでスキャルピングについて次回書いてみようかと思います。</p>

  </div>
</div>



@section('scripts')

@endsection

@endsection
