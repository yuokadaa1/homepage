@extends('layouts.default')

@section('title', '学習サイト')

@section('content')
<h3>学習コンテンツ一覧</h3>
<!-- <p><span class="label label-danger">HOME</span> -> 学習コンテンツ一覧</p> -->

  <!-- <div class="container">
    <div class="form-group">
      <p class="text-center bg-info">学習コンテンツ一覧</p>
    </div>
  </div> -->

  <ul class="nav flex-column">
    <li class="nav-item">

      <div class="d-flex align-items-center">
        <a href="#" class="nav-link"> menu1 </a>
        <button class="btn btn-link btn-sm" data-target="#collapse-menu1" data-toggle="collapse">
          <i class="material-icons">ソフトウェアマネジメントについて</i>
        </button>
      </div>
      <div>
        <ul id="collapse-menu1" class="collapse list-unstyled pl-3">
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-0") }}>menu1-0 この科目で学習する内容</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-1") }}>menu1-1 ソフトウェアの定義と歴史について</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-2") }}>menu1-2 ソフトウェア開発とプロセスモデル①</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-3") }}>menu1-3 ソフトウェア開発とプロセスモデル②</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-4") }}>menu1-4 プロジェクト管理</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-5") }}>menu1-5 ソフトウェア見積技法</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-6") }}>menu1-6 構造化手法</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-7") }}>menu1-7 設計工程</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-8") }}>menu1-8 構造化プログラミング</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-9") }}>menu1-9 プログラミング環境</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-10") }}>menu1-10 Webプログラミング</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-11") }}>menu1-11 ソフトウェアの品質</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-12") }}>menu1-12 テスト工程</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-13") }}>menu1-13 保守プロセス</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-14") }}>menu1-14 標準化</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-15") }}>menu1-15 グループワーク￥ガイダンス</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/1-16") }}>menu1-16 要件定義と最終目標</a></li>
        </ul>
      </div>

      <div class="d-flex align-items-center">
        <a href="#" class="nav-link"> menu2 </a>
        <button class="btn btn-link btn-sm" data-target="#collapse-menu2" data-toggle="collapse">
          <i class="material-icons">情報処理試験対策</i>
        </button>
      </div>
      <div>
        <ul id="collapse-menu2" class="collapse list-unstyled pl-3">
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/2-0") }}>menu2-0 この科目で学習する内容</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/2-1") }}>menu2-1 コンピュータの基本構成</a></li>
          <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/2-2") }}>menu2-2 ハードウェア</a></li>
        </ul>
      </div>

      <div class="d-flex align-items-center">
        <a href="#" class="nav-link"> menu3 </a>
        <button class="btn btn-link btn-sm" data-target="#collapse-menu3" data-toggle="collapse">
          <i class="material-icons">UML</i>
        </button>
      </div>
      <ul id="collapse-menu3" class="collapse list-unstyled pl-3">
        <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/3-0") }}>menu3-0 この科目で学習する内容</a></li>
        <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/3-1") }}>menu3-1 クラス図の復習</a></li>
        <li class="ml-3 my-0 py-0"><a href={{ url("/lesson/3-2") }}>menu3-2 概念モデルとは</a></li>
      </ul>

    </li>
  </ul>


@section('scripts')
    <!-- <script src="/js/starter-template.js"></script> -->
    <script src="{{ asset('/js/lesson.js') }}"></script>

@endsection

@endsection
