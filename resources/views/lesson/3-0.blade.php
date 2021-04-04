@extends('layouts.default')

@section('title', '情報処理試験対策')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/lesson">学習コンテンツ一覧</a></li>
    <li class="breadcrumb-item">UML</li>
    <li class="breadcrumb-item">この科目で学習する内容</li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>UML</h3>
</div>

<div class="container mb-4" >
  <div class="card card-body" >
    <a>目次<a>
    <a href="#ZERO" class="router-link-exact-active router-link-active" style="text-indent:1em;">この科目で学習する内容</a>
    <a href="#1st" class="router-link-exact-active router-link-active" style="text-indent:1em;">UMLとは何か</a>
    <a href="#2nd" class="router-link-exact-active router-link-active" style="text-indent:1em;">UMLの必要性</a>
    <a href="#3rd" class="router-link-exact-active router-link-active" style="text-indent:1em;">UMLの種類</a>
  </div>
</div>

<div class="container mb-4" id="ZERO">
  <h5>この科目で学習する内容</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">この科目では<u><a style="color:red;">UML</a></u>を学習し、図から情報を読み取る／図を作成できるようになることを目標とする。</p>
  </div>
</div>


<div class="container mb-4" id="1st">
  <h5>UMLとは何か</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">Unified Modeling Languageの略。オブジェクト指向（主にJava,PHP,Ruby,C++,C#等）でシステムを設計する際に利用する図とその目的、及び記法を定めた規格。<u><a style="color:red;">設計書</a></u>の記載方法。</p>
    <p>共通の設計規格を作ることで開発現場ごとに設計書の記載方法が変わる、という状態を回避するための表現。</p>
  </div>
</div>

<div class="container mb-4" id="2nd">
  <h5>UMLの必要性</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">意志の疎通における確認のコストを減らせる。</p>
    <p>一般的に設計者作成者と実装（プログラマー）は異なる。仮に各人ごとに書き方の異なる設計書が作成された場合プログラマーは設計書の意図を設計者に何度も尋ねる必要が出てくる。</p>
    <p>また、共通規格に則った設計書であれば必要な情報の捜索方法などが容易になる。</p>
    <p>つまり、意図を正しく簡易に伝えるために必要となる。</p>
  </div>
</div>

<div class="container mb-4" id="3rd">
  <h5>UMLの種類</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">表現したい事柄ごとに設計書の規格が存在する。</p>
    <p class="font-weight-bold"><u>構造に関する表記</u></p>
    <p>・クラス図</p>
    <p>・オブジェクト図</p>
    <p>・パッケージ図</p>
    <p>・コンポーネント図</p>
    <p>・複合構造図</p>
    <p>・配置図</p>
    <p class="font-weight-bold"><u>振る舞いに関する表記</u></p>
    <p>・アクティビティ図</p>
    <p>・相互作用概観図</p>
    <p>・コミュニケーション/コラボレーション図</p>
    <p>・シーケンス図</p>
    <p>・状態マシン図</p>
    <p>・タイミング図</p>
    <p>・ユースケース図</p>
  </div>
</div>

@section('scripts')

@endsection

@endsection
