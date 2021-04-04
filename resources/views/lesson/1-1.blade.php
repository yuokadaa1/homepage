@extends('layouts.default')

@section('title', 'ソフトウェア・エンジニアリング')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/lesson">学習コンテンツ一覧</a></li>
    <li class="breadcrumb-item">ソフトウェア・エンジニアリング</li>
    <li class="breadcrumb-item">ソフトウェアの定義と歴史について</li>
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
  <h5>この章で学習する内容</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">ソフトウェアの定義と歴史を知り必要性を理解する。</p>
  </div>
</div>


<div class="container mb-4" id="1st">
  <h5>ソフトウェアとは</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">ハードウェアと対になる存在（HW/SW）。</p>
    <p>一般的に、HWを操作するプログラムをSWと呼ぶ。</p>
    <p>厳密には、<a href="https://www.jisc.go.jp/index.html">JIS</a>にて「<u>情報処理システムのプログラム，手続き，規則及び関連文書の全体又は一部分。 備考 ソフトウェアは，それを記録した媒体とは無関係な知的創作物である。</u>」と定義されている。</p>
  </div>
</div>

<div class="container mb-4" id="2nd">
  <h5>コンピュータとソフトウェアの歴史</h5>
  <div style="padding-left: 1em;">
    <p class="my-2">コンピュータの発展に併せてソフトウェアも変化・発展していった。</p>
    <p>・非ノイマン型コンピュータからノイマン型コンピュータに。</p>
    <p>・機械語言語から低水準言語を経て高水準言語に。</p>
  </div>
</div>

@section('scripts')

@endsection

@endsection
