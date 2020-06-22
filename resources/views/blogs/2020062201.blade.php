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

  <h5>入力パラメータ</h5>

  <div  style="padding-left: 1em;">
    <p></p>
  </div>

  <div class="container">
    <form method="post" action="{{ url('/blog/2020052701') }}">
      {{ csrf_field() }}
      <div class="form-group">

        <div class="form-inline">
          <label class="col-sm-3 control-label" for="username">通貨ペア</label>
          <select class="form-control" id="selectPair" name="selectPair">
            @for ($i = 0; $i < count($json); $i++)
              @empty( $requestD )
                @if ( $json[$i]['cid'] == 0 )
                  <option value={{ $json[$i]['cid'] }} selected> {{ $json[$i]['currency'] }} </option>
                @else
                  <option value={{ $json[$i]['cid'] }}> {{ $json[$i]['currency'] }} </option>
                @endif
              @else
                @if ( $json[$i]['cid'] == $requestD->selectPair )
                  <option value={{ $json[$i]['cid'] }} selected> {{ $json[$i]['currency'] }} </option>
                @else
                  <option value={{ $json[$i]['cid'] }}> {{ $json[$i]['currency'] }} </option>
                @endif
              @endempty
            @endfor
          </select>
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
