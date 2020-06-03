@extends('layouts.default')

@section('title', 'FX証拠金シミュレータ')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/blog">更新ブログ一覧</a></li>
    <li class="breadcrumb-item">FX証拠金シミュレータ</li>
  </ol>
</nav>

<div class="container mb-4">
  <h3>FX証拠金シミュレータ</h3>
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
             <option value="0" selected>USD/JPY</option>
             <option value="1">USD/KRW</option>
             <option value="2">GBP/USD</option>
             <option value="3">GBP/JPY</option>
          </select>
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">レート</label>
          <input type="number" step="0.001" class="col-sm-2 form-control" id="inputRate" value='{{old('name', $json[0]["price"])}}'>
          <!-- <input type="submit" id="button1" value="現在のレート" class="btn btn-success btn-wide" /> -->
        </div>

        <!-- JavaScriptを呼び出してレートの現在値をセット。 -->
        <script type="text/javascript">let data = <?php echo json_encode($json); ?>;</script>
        <script src="{{ asset('/js/hp20200527.js') }}"></script>

        <div class="form-inline">
          <label class="col-sm-3 control-label">純資産額</label>
          <input type="number" step="100000" id="netAssets" name="numNetAssets" class="col-sm-2 form-control" value='{{old('name', 1000000)}}'>
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">売買</label>
          <select class="form-control" id="selBuySell" name="selBuySell">
             <option value="0" selected>買</option>
             <option value="1">売</option>
          </select>
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label" for="username">最大レバレッジ</label>
          <select class="form-control" id="selLeverage" name="selLeverage">
             <option value="0" selected>25</option>
             <option value="1">50</option>
             <option value="2">100</option>
             <option value="3">200</option>
             <option value="4">400</option>
          </select>
          <p>倍</p>
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">取引数量</label>
          <input type="number" step="1" id="numAmount" name="numAmount" class="col-sm-1 form-control" value='{{old('name', 100)}}'>
          <p>×100 通貨</p>
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">ロスカット証拠金維持率</label>
          <select class="form-control" id="selMaintenanceRate" name="selMaintenanceRate">
             <option value="0" selected>10</option>
             <option value="1">20</option>
             <option value="2" selected>30</option>
             <option value="3">40</option>
             <option value="4">50</option>
             <option value="5">60</option>
             <option value="6">70</option>
             <option value="7">80</option>
             <option value="8">90</option>
             <option value="9">100</option>
          </select>
          <p>%</p>
        </div>

        <input type="submit" name="button1" value="計算開始" class="btn btn-success btn-wide" />

      </div>
    </form>
  </div>

  <h5>計算結果</h5>
  <div class="form-inline">
    <label class="col-sm-3 control-label">必要証拠金</label>
    <text  class="col-sm-3 ">aaa</text>
  </div>
  <div class="form-inline">
    <label class="col-sm-3 control-label">ロスカット基準額</label>
    <text  class="col-sm-3 ">aaa</text>
  </div>
  <div class="form-inline">
    <label class="col-sm-3 control-label">スワップポイント</label>
    <text  class="col-sm-3 ">aaa</text>
  </div>

</div>

@section('scripts')

@endsection

@endsection
