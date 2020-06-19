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


<div class="container mb-4" id="1st">
  <h5>寄り値がその日の天井・底になる</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">日本株は寄り値がその日の最高値・最安値になりやすい。</p>
    <p>この検証をして個人投資家の助けにすることができるか検証していきます。</p>

  </div>
</div>

<div class="container mb-4" id="#1st">
  <h5>寄り値がその日の天井・底になる</h5>
  <div  style="padding-left: 1em;">

    <p class="my-2">日本株は寄り値（寄り付きの値段）がその日の最高値・最安値になりやすいです。</p>
    <p>正しくは、株価が上がる日は始まってから数分上昇し、上昇が止まった時がその日の高値となります。</p>
    <p>この検証をして個人投資家の助けにすることができるか検証していきます。</p>

  </div>
</div>



@section('scripts')

@endsection

@endsection
