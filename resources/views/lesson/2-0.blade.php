@extends('layouts.default')

@section('title', '情報処理試験対策')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/lesson">学習コンテンツ一覧</a></li>
    <li class="breadcrumb-item">情報処理試験対策</li>
    <li class="breadcrumb-item">この科目で学習する内容</li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>情報処理試験対策</h3>
</div>

<div class="container mb-4" >
  <div class="card card-body" >
    <a>目次<a>
    <a href="#ZERO" class="router-link-exact-active router-link-active" style="text-indent:1em;">この科目で学習する内容</a>
    <a href="#1st" class="router-link-exact-active router-link-active" style="text-indent:1em;">学習の前に</a>
    <a href="#2nd" class="router-link-exact-active router-link-active" style="text-indent:1em;">スケジュール</a>
  </div>
</div>

<div class="container mb-4" id="ZERO">
  <h5>この科目で学習する内容</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">この科目では<u><a style="color:red;">情報処理試験の合格</a></u>を目指し学習する。</p>
    <p>過去問を解いていくことにより情報処理試験の合格水準を目指す。</p>
  </div>
</div>


<div class="container mb-4" id="1st">
  <h5>学習の前に</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">学習開始の前に、情報処理試験を受験する理由を理解する。</p>
    <p><a href="https://drive.google.com/file/d/1jQd-b5q-5MobgUfqSm9M5mbtn2FFJKb6/view?usp=sharing" target=”_blank”>PowerPoint</a>にまとめているので参照</p>
  </div>
</div>

<div class="container mb-4" id="1st">
  <h5>スケジュール</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">2021年の試験予定日を記載する。</p>
    <p>5～6月：<a style="color:blue;">基本情報処理技術者試験</a></p>
    <p>5/28(金)：情報処理技術者能力認定試験3級</p>
    <p>6/25(金)：情報処理技術者能力認定試験2級1部</p>
    <p>7/25(日)：<a style="color:red;">基本情報処理技術者午前免除試験</a></p>
    <p>10/17(日)予定：<a style="color:blue;">応用情報処理技術者試験</a></p>
    <p>12/17(金)：情報処理技術者能力認定試験2級2部</p>
    <p>10～11月：<a style="color:red;">基本情報処理技術者試験</a></p>
    <p class="mt-2">実質余談となるが、基本以外の情報処理試験の合格発表は試験2ヶ月後のため、就職活動に間に合わせるためには1年後期で合格する必要がある。</p>
  </div>
</div>


@section('scripts')

@endsection

@endsection
