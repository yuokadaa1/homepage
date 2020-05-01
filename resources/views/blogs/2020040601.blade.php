@extends('layouts.default')

@section('title', '各国市場のタイムテーブル')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/blog">更新ブログ一覧</a></li>
    <li class="breadcrumb-item">各国市場のタイムテーブル</li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>各国市場のタイムテーブル</h3>
</div>

<div class="container mb-4" id="1st">
  <h5>タイムテーブル</h5>
  <div style="padding-left: 1em;">
    <p class="my-2">忘れがちなので書き込んで覚えておきます。</p>

    <div class="progress">
      <div class="progress-bar" role="progressbar" style="width: 4.16%">0</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">1</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">2</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">3</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">4</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">5</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">6</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">7</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">8</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">9</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">10</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">11</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">12</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">13</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">14</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">15</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">16</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">17</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">18</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">19</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">20</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">21</div>
      <div class="progress-bar" role="progressbar" style="width: 4.16%">22</div>
      <div class="progress-bar" role="progressbar" style="width: 4.32%">23</div>
    </div>
    <div class="progress">
      <div role="progressbar" style="width:37.44%;"></div>
      <div class="progress-bar" role="progressbar" style="width:24.96%;">0700 - 1600</div><span class="ml-1">オーストラリア時間</span>
    </div>
    <div class="progress">
      <div role="progressbar" style="width:37.44%;"></div>
      <div class="progress-bar" role="progressbar" style="width:24.96%;">0900 - 1800</div><span class="ml-1">東京時間</span>
    </div>
    <div class="progress">
      <div role="progressbar" style="width:37.44%;"></div>
      <div class="progress-bar" role="progressbar" style="width:24.96%;">0955</div><span class="ml-1">東京仲値</span>
    </div>
    <div class="progress">
      <div role="progressbar" style="width:37.44%;"></div>
      <div class="progress-bar" role="progressbar" style="width:24.96%;">1500</div><span class="ml-1">東京OPカット</span>
    </div>
    <div class="progress">
      <div role="progressbar" style="width:37.44%;"></div>
      <div class="progress-bar" role="progressbar" style="width:24.96%;">1700 - 0100</div><span class="ml-1">ロンドン時間</span>
    </div>
    <div class="progress">
      <div role="progressbar" style="width:37.44%;"></div>
      <div class="progress-bar" role="progressbar" style="width:24.96%;">2400</div><span class="ml-1">ロンドンFIX</span>
    </div>

    <div class="progress">
      <div role="progressbar" style="width:37.44%;"></div>
      <div class="progress-bar" role="progressbar" style="width:24.96%;">2300 - 0600</div><span class="ml-1">ニューヨーク時間</span>
    </div>
    <div class="progress">
      <div role="progressbar" style="width:37.44%;"></div>
      <div class="progress-bar" role="progressbar" style="width:24.96%;">2400</div><span class="ml-1">NYOPカット</span>
    </div>
    <div class="progress">
      <div role="progressbar" style="width:37.44%;"></div>
      <div class="progress-bar" role="progressbar" style="width:24.96%;">2200 - 0700</div><span class="ml-1">ニューヨーク時間(サマータイム)</span>
    </div>
    <div class="progress">
      <div role="progressbar" style="width:37.44%;"></div>
      <div class="progress-bar" role="progressbar" style="width:24.96%;">2300</div><span class="ml-1">NYOPカット(サマータイム)</span>
    </div>


  </div>
</div>



@section('scripts')

@endsection

@endsection
