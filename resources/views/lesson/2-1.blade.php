@extends('layouts.default')

@section('title', '情報処理試験対策')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/lesson">学習コンテンツ一覧</a></li>
    <li class="breadcrumb-item">情報処理試験対策</li>
    <li class="breadcrumb-item">コンピュータの基本構成</li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>情報処理試験対策</h3>
</div>

<div class="container mb-4" >
  <div class="card card-body" >
    <a>目次<a>
    <a href="#ZERO" class="router-link-exact-active router-link-active" style="text-indent:1em;">この章で学習する内容</a>
    <a href="#1st" class="router-link-exact-active router-link-active" style="text-indent:1em;">コンピュータの基本構成</a>
    <a href="#2nd" class="router-link-exact-active router-link-active" style="text-indent:1em;">過去問</a>
  </div>
</div>

<div class="container mb-4" id="ZERO">
  <h5>はじめに</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">この章で学習する内容</p>
    <p>コンピュータの基本構成を理解する。</p>
    <p>
      ソフトウェアの学習の前にハードウェアとその挙動を理解し、SWの理解を早める。
    </p>
  </div>
</div>


<div class="container mb-4" id="1st">
  <h5>コンピュータの基本構成</h5>
  <div  style="padding-left: 1em;">
    <p><a href="https://drive.google.com/file/d/1OMO_7-pAkBer8DnrTSGs1QmdxHJSpp51/view?usp=sharing" target="_blank">リンク先</a>のPDFまとめているので参照</p>
    <a>教科書-ITワールドのP12～17、演習問題P98-問1</a>
  </div>
</div>

<div class="container mb-4" id="2nd">
  <h5>過去問を解く</h5>
  <div style="padding-left: 1em;">
    <p class="my-2">
    </p>
  </div>
</div>

@section('scripts')

@endsection

@endsection
