@extends('layouts.default')

@section('title', 'ソフトウェア・エンジニアリング')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/lesson">学習コンテンツ一覧</a></li>
    <li class="breadcrumb-item"><a href="/lesson">ソフトウェア・エンジニアリング</a></li>
    <li class="breadcrumb-item"><a>この科目で学習する内容</a></li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>ソフトウェア・エンジニアリング</h3>
</div>

<div class="container mb-4" >
  <div class="card card-body" >
    <a>目次<a>
    <a href="#ZERO" class="router-link-exact-active router-link-active" style="text-indent:1em;">この科目で学習する内容</a>
    <a href="#1st" class="router-link-exact-active router-link-active" style="text-indent:1em;">ソフトウェアエンジニアリングとは</a>
    <a href="#2nd" class="router-link-exact-active router-link-active" style="text-indent:1em;">なぜ必要か①</a>
    <a href="#3rd" class="router-link-exact-active router-link-active" style="text-indent:1em;">なぜ必要か②</a>
    <a href="#4th" class="router-link-exact-active router-link-active" style="text-indent:1em;">ソフトウェア開発の順序</a>
    <a href="#5th" class="router-link-exact-active router-link-active" style="text-indent:1em;">ソフトウェア開発で必要となる資料</a>
  </div>
</div>

<div class="container mb-4" id="ZERO">
  <h5>この科目で学習する内容</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">この科目では<u><a style="color:red;">ソフトウェアエンジニアリング</a></u>の知識について学習する。</p>
    <p>ソフトウェアエンジニアリングとは何か、どのような知識でどのように有用なのか。</p>
    <p>歴史や背景、実例を合わせて紹介していきます。</p>
  </div>
</div>


<div class="container mb-4" id="1st">
  <h5>ソフトウェアエンジニアリングとは</h5>
  <div  style="padding-left: 1em;">
    <p class="my-2">ソフトウェア開発にあたって習得しておくべき知識群のこと。</p>
    <p>どうすればよりよいソフトウェア開発に至れるかを学習するもの。</p>
    <p>ソフトウェアエンジニアリング基礎知識体系(SWEBOK,Software Engineering Body of Knowledge)として体系化されており、以下の領域に分かれている。</p>
    <ul>
      <li data-toggle="tooltip" title="顧客の要求を定義する。実現可能か、コスト・リリース日・妥当な品質か、などを検討する。">ソフトウェア要求</li>
      <li data-toggle="tooltip" title="どのようにして顧客の要求を実現するか定義する。プログラムの分割方法やイベント制御、UIの挙動など。ソフトウェア構築へ向けて準備を行う。">ソフトウェア設計</li>
      <li data-toggle="tooltip" title="">ソフトウェア構築</li>
      <li data-toggle="tooltip" title="">ソフトウェア保守</li>
      <li data-toggle="tooltip" title="">ソフトウェア構成管理</li>
      <li data-toggle="tooltip" title="">ソフトウェア・エンジニアリング・マネジメント</li>
      <li data-toggle="tooltip" title="">ソフトウェア・マネジメント・プロセス</li>
      <li data-toggle="tooltip" title="">ソフトウェア・エンジニアリングのためのツールおよび技法</li>
      <li data-toggle="tooltip" title="">ソフトウェア品質</li>
    </ul>
    <p  class="mt-2">
      当然、これらを1字1句違わず覚える必要も全て理解している必要もないが、何となくわかる／調べればわかる程度の理解が必要となる。
    </p>

  </div>
</div>

<div class="container mb-4" id="2nd">
  <h5>なぜ必要か①</h5>
  <div style="padding-left: 1em;">
    <p class="my-2">手間と時間をかけないと正しくソフトウェアが作成されないため。</p>
    <p>本来、企業が欲しいのは完璧なプログラムのみであり、付帯する設計資料やテスト結果などは必要としていない。</p>
    <p>しかし、実際に要件定義や設計、テストを実施しないで作成されたソフトウェアはほぼ間違いなく欠陥品となる。</p>
    <p>作成するプログラムが欠陥品であることを避けるために必要な知識を整理した結果がソフトウェアエンジニアリングである。</p>

    <div class="my-2 border border-info">
      <p><a class="font-weight-bold">完璧なプログラム</a>とは何か</p>
      <p class="ml-3">企業の思い通りの挙動をし、変更したくなったところは随時簡易に変更できる。</p>
      <p class="ml-3">夢物語である。</p>
    </div>
  </div>
</div>

<div class="container mb-4" id="3rd">
  <h5>なぜ必要か②</h5>
  <div style="padding-left: 1em;">
    <p class="my-2">
      <u>経験したもの以外</u>の知識を取得するため。
    </p>
    <p>技術も知識も個人に属するものであり、普通人間は経験したことしか実行できない。</p>
    <p>しかし、実際には経験したことがないからわかりません。なんてものは通じない。</p>
    <p>そのため、ソフトウェア開発において何が必要なのかを体系的にまとめて適宜引用するために開発されたもの。</p>
    <p>
      下のイメージ図の通り、ソフトウェア開発にあたっては多種多様の人物が参加して行われる。
      <a href="https://docs.google.com/spreadsheets/d/e/2PACX-1vR-PZxEz9l5o8gpeN-MAQsvF2Or8lg5TTwcuPmNoZ-3rkvDTHe0gDNfN71gehNWx10tBaoh5d1QPjQu/pubhtml" target=”_blank”>イメージ図へのリンク</a>
    </p>
    <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR-PZxEz9l5o8gpeN-MAQsvF2Or8lg5TTwcuPmNoZ-3rkvDTHe0gDNfN71gehNWx10tBaoh5d1QPjQu/pubhtml?gid=0&amp;single=true&amp;widget=true&amp;headers=false" style="width:640px; height:300px" &gid=0&range=b2:030></iframe>

    <p>
      知識も経験も、会社も立場も異なる人間が集まってソフトウェア開発を行う。
    </p>
    <p>
      この登場人物達の中で正しく<a style="color:red;">ソフトウェア開発を理解すべきは<u>発注企業IT部</u>と<u>システム受注企業</u>であり、営業部は理解が不足していてもよい。</a>
    </p>
    <p>それぞれ専門分野が違い、発注企業-営業部のIT知識欠損は発注企業-IT部が補完するからである。</p>
    <p>そのため、IT技術者というのはIT専門家以外ともコミュニケーションが取れる必要がある。</p>

  </div>
</div>

<div class="container mb-4" id="4th">
  <h5>ソフトウェア開発の順序</h5>
  <div style="padding-left: 1em;">
    <p class="my-2">
      ソフトウェア開発の順序を大まかに記載する。
    </p>
    <p>発注企業がソフトウェア開発を要望する。</p>
    <p>受注企業がソフトウェア開発を請け負う。</p>
    <p>発注企業と受注企業が開発内容を合意する（ソフトウェア要求）。</p>
    <p>受注企業がソフトウェア設計を行い発注企業が確認する（ソフトウェア設計）。</p>
    <p>受注企業がソフトウェア構築（プログラミング）を行い発注企業が確認する（ソフトウェア構築）。</p>
    <p>受注企業がソフトウェア（プログラム等）を発注企業に納品する。</p>
    <p>発注企業がソフトウェアを保守管理し、適宜変更する（ソフトウェア保守）。</p>
  </div>
</div>

<div class="container mb-4" id="5th">
  <h5>ソフトウェア開発で必要となる資料</h5>
  <div style="padding-left: 1em;">
    <p class="my-2">
      ソフトウェア開発で必要となる資料を記載する。詳細はSWEBOKに定義されているので最低限必要なものを記載。
      これらの資料はフォーマットが定義されているわけてはなく、各社独自のものを作成している。
      上流工程についてはIPAがサンプルを公開していたりする。
    </p>
    <p class="mt-2 ml-2">・<a href="https://www.ipa.go.jp/sec/softwareengineering/tool/ep/ep2.html" target="_blank">要件定義書</a></p>
    <p class="ml-4">顧客の要望が取りまとめられたもの。移行日や開発すべき内容が記載されている。</p>
    <p class="ml-4">Webページから顧客情報を登録できるようにしたい。本番リリース：2021/10/10。開発費用：500万円</p>
    <p class="mt-2 ml-2">・<a>基本設計書</a></a></p>
    <p class="ml-4">ソフトウェアが外部から見た時の挙動を記載する。</p>
    <p class="ml-4">Webページで顧客情報を取り込んでDBに登録する、または取り出す際の挙動など。</p>
    <p class="mt-2 ml-2">・<a>詳細設計書</a></p>
    <p class="ml-4">作らなければならないWebページの定義と、登録するDBの定義。</p>
    <p class="mt-2 ml-2">・<a>テスト仕様書</a></p>
    <p class="ml-4">作ったシステムが正しく挙動していることを証明するためのテストの方法を記載。</p>
    <p class="mt-2 ml-2">・<a>移行手順書</a></p>
    <p class="ml-4">どのような手順でシステムをリリースするか、リリース後バグがあった際の対処などを定義する。</p>
  </div>
</div>

@section('scripts')
<script src="{{ asset('/js/lesson.js') }}"></script>

@endsection

@endsection
