@extends('layouts.default')

@section('title', 'ソフトウェア・エンジニアリング')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/lesson">学習コンテンツ一覧</a></li>
    <li class="breadcrumb-item">ソフトウェア・エンジニアリング</li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>ソフトウェア・エンジニアリング</h3>
</div>

<div class="container mb-4" >
  <div class="card card-body" >
    <a>目次<a>
    <a href="#ZERO" class="router-link-exact-active router-link-active" style="text-indent:1em;">この章で学習する内容</a>
    <a href="#1st" class="router-link-exact-active router-link-active" style="text-indent:1em;">定義とよりよいソフトウェア</a>
    <a href="#2nd" class="router-link-exact-active router-link-active" style="text-indent:1em;">歴史について</a>
  </div>
</div>

<div class="container mb-4" id="ZERO">
  <h5>はじめに</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">この章で学習する内容</p>
    <p>
      この章では<u><a style="color:red;">ソフトウェアエンジニアリング</a></u>の必要性について語る。
    </p>
    <p>
      なぜこんなものが必要なのかを理解し、以降に学習する内容の目的を理解する。
    </p>
  </div>
</div>


<div class="container mb-4" id="1st">
  <h5>ソフトウェアエンジニアリングとは</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2"></p>
    <p></p>
  </div>
</div>

<div class="container mb-4" id="2nd">
  <h5></h5>
  <div style="padding-left: 1em;">
    <p class="my-2">
    </p>
  </div>
</div>

@section('scripts')

@endsection

@endsection
