@extends('layouts.default')

@section('title', '決算書指標計算シミュレータ')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/blog">更新ブログ一覧</a></li>
    <li class="breadcrumb-item">決算書指標計算シミュレータ</li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>決算書指標計算シミュレータ</h3>
</div>

<div class="container mb-4" id="1st">

  <h5>作ろうとしていたのですが、悲しいかなすでに優良なものがwebに公開されていました</h5>
  <div class="container">
    <p>https://ufocatch.com/</p>
    <p>のサイトを見てください。</p>
    <p>個社の検討ができても企業間の比較がしづらいようなので気が向いたら当サイトで</p>
    <p>作ろうかとは思いますが、優先度は低めです。</p>
  </div>
  
  <h5>入力パラメータ</h5>

  <div  style="padding-left: 1em;">
    <p></p>
  </div>

  <div class="container">
    <form method="post" action="{{ url('/blog/2020052701') }}">
      {{ csrf_field() }}
      <div class="form-group">

        <div class="form-inline">
          <label class="col-sm-3 control-label">会社番号</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate"
            @isset( $requestD )
              value='{{ old("inputRate", $requestD->inputRate) }}'>
            @else
              '>
            @endisset
        </div>

        <label class="col-sm-3 control-label">貸借対照表（資産の部）</label>

        <div class="form-inline">
          <label class="col-sm-3 control-label">資産合計</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">流動資産</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">当座資産</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">固定資産</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <label class="col-sm-3 control-label">貸借対照表（負債の部）</label>

        <div class="form-inline">
          <label class="col-sm-3 control-label">負債合計</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <label class="col-sm-3 control-label">貸借対象表（純資産の部）</label>

        <div class="form-inline">
          <label class="col-sm-3 control-label">純資産合計</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <label class="col-sm-3 control-label">損益計算書</label>

        <div class="form-inline">
          <label class="col-sm-3 control-label">売上高</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">売上原価</label>
        </div>
        <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />

        <div class="form-inline">
          <label class="col-sm-3 control-label">営業利益</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">営業外収益</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">営業外費用</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">当期純利益</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <label class="col-sm-3 control-label">キャッシュフロー計算書</label>

        <div class="form-inline">
          <label class="col-sm-3 control-label">営業ＣＦ</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">投資ＣＦ</label>
          <input type="number" step="1" class="col-sm-2 form-control" id="inputRate" name="inputRate" />
        </div>

        <input type="submit" name="button1" value="計算開始" class="btn btn-success btn-wide" />

      </div>
    </form>
  </div>

  <h5>計算結果</h5>
  @isset( $json2 )
    @empty ( $requestD->button2 )
      <div class="form-inline">
        <label class="col-sm-3 control-label">合計必要証拠金</label>
        <text  class="col-sm-3 ">{{ number_format( $json2["requiredMargin"] ) }}</text>
        <p>円</p>
      </div>
      <div class="form-inline">
        <label class="col-sm-3 control-label">ロスカット基準額</label>
        <text  class="col-sm-3 ">{{ number_format( $json2["remainderMoney"] ) }}</text>
        <p>円</p>
      </div>
      <div class="form-inline">
        <label class="col-sm-3 control-label">ロスカット発生レート</label>
        <text  class="col-sm-3 ">{{ $json2["lossCutRate"] }}</text>
        <p>円</p>
      </div>
      <div class="form-inline">
        <label class="col-sm-3 control-label">ロスカット発生pips</label>
        <text  class="col-sm-3 ">{{ $json2["remainderpips"] }}</text>
        <p>pips</p>
      </div>
      <div class="form-inline">
        <label class="col-sm-3 control-label">スワップポイント</label>
        <text  class="col-sm-3 ">{{ $json2["swapPoint"] }}</text>
        <p>円</p>
      </div>
      <div class="form-inline">
        <label class="col-sm-3 control-label">1pips変動時のレート</label>
        <text  class="col-sm-3 ">1pips変動時のレート</text>
        <p>円</p>
      </div>
      <div class="form-inline">
        <label class="col-sm-3 control-label">決済レート時の損益</label>
        <text  class="col-sm-3 ">決済レート時の損益</text>
        <p>円</p>
      </div>
    @endempty
  @endisset

</div>

@section('scripts')

@endsection

@endsection
