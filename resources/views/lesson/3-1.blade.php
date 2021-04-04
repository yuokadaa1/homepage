@extends('layouts.default')

@section('title', 'ソフトウェア・エンジニアリング')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/lesson">学習コンテンツ一覧</a></li>
    <li class="breadcrumb-item">ソフトウェア・エンジニアリング</li>
    <li class="breadcrumb-item">クラス図の復習</li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>ソフトウェア・エンジニアリング</h3>
</div>

<div class="container mb-4" >
  <div class="card card-body" >
    <a>目次<a>
    <a href="#ZERO" class="router-link-exact-active router-link-active" style="text-indent:1em;">この章で学習する内容</a>
    <a href="#1st" class="router-link-exact-active router-link-active" style="text-indent:1em;">クラス図とは</a>
    <a href="#2nd" class="router-link-exact-active router-link-active" style="text-indent:1em;">クラス図を作成するメリット</a>
    <a href="#3rd" class="router-link-exact-active router-link-active" style="text-indent:1em;">クラス図の記載ルール</a>
    <a href="#4th" class="router-link-exact-active router-link-active" style="text-indent:1em;">クラス図作成の練習</a>
  </div>
</div>

<div class="container mb-4" id="ZERO">
  <h5>この章で学習する内容</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">この章ではクラス図の復習にあたり、以降の学習のための基礎を確認する。</p>
  </div>
</div>


<div class="container mb-4" id="1st">
  <h5>クラス図とは</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">UMLの一種。システムの静的な構造・関係性を視覚的に表現するための図。</p>
    <p>静的の反対は動的。動的な図はアクションが発生したときの挙動を示す(シーケンス図、アクティビティ図)。</p>
  </div>
</div>

<div class="container mb-4" id="2nd">
  <h5>クラス図を作成するメリット</h5>
  <!-- <div style="padding-left: 1em;"> -->
  <div>
    <ul>
      <li>専門的な知識・用語を使わずに意思疎通を計れる。</li>
      <li>システム全体を俯瞰的に図示することで全体の概要を把握できる。</li>
      <li>クラス間の関係を把握できる。</li>
    </ul>
  </div>
</div>

<div class="container mb-4" id="3rd">
  <h5>クラス図の記載ルール</h5>
  <!-- <div style="padding-left: 1em;"> -->
  <div>
    <ul>
      <li>1つのクラスにはクラス名・属性・操作を記載する。</li>
      <li>クラス間の関係に関連・多重度・誘導可能性を記載する。</li>
      <li>継承関係を般化・実現で記載する。</li>
      <li>クラス間の関係が全体と部分であれば集約として記載する。</li>
    </ul>
  </div>
</div>

<div class="container mb-4" id="4th">
  <h5>クラス図作成の練習</h5>
  <div style="padding-left: 1em;">
    <p class="my-2">練習問題を参照して</p>
    <p>P6~34</p>

  </div>
</div>


@section('scripts')

@endsection

@endsection
