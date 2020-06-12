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

        <div class="form-inline">
          <label class="col-sm-3 control-label">レート</label>
          <input type="number" step="0.001" class="col-sm-2 form-control" id="inputRate" name="inputRate"
            @isset( $requestD )
              value='{{ old("inputRate", $requestD->inputRate) }}'>
            @else
              value='{{ old("inputRate", $json[0]["price"])}}'>
            @endisset
          <input type="submit" name="button2" value="現在のレートを取得" class="btn btn-success btn-wide" />
        </div>

        <!-- JavaScriptを呼び出してレートの現在値をセット。 -->
        <script type="text/javascript">let data = <?php echo json_encode($json); ?>;</script>
        <script src="{{ asset('/js/hp20200527.js') }}"></script>

        <div class="form-inline">
          <label class="col-sm-3 control-label">純資産額</label>
          <input type="number" step="100000" id="numNetAssets" name="numNetAssets" class="col-sm-2 form-control"
            @isset( $requestD )
              value='{{ old('name', $requestD->numNetAssets) }}'>
            @else
              value='{{ old('name', 1000000) }}'>
            @endisset
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">売買</label>
          <select class="form-control" id="selBuySell" name="selBuySell">
            @empty( $requestD )
              <option value="0" selected>買</option>
              <option value="1">売</option>
            @else
              @if ( $requestD->selBuySell == 0 )
                <option value="0" selected>買</option>
                <option value="1">売</option>
              @else
                <option value="0">買</option>
                <option value="1" selected>売</option>
              @endif
            @endisset
          </select>
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label" for="username">最大レバレッジ</label>
          <select class="form-control" id="selLeverage" name="selLeverage">
            @foreach(config('20200527_selLeverage') as $index => $name)
              @empty( $requestD )
                @if ( $index == 0 )
                  <option value="{{ $index }}" selected> {{ $name }} </option>
                @else
                  <option value="{{ $index }}"> {{ $name }} </option>
                @endif
              @else
                @if ( $index == $requestD->selLeverage )
                  <option value="{{ $index }}" selected> {{ $name }} </option>
                @else
                  <option value="{{ $index }}"> {{ $name }} </option>
                @endif
              @endempty
            @endforeach
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
            @foreach(config('20200527_selMaintenanceRate') as $index => $name)
              @empty( $requestD )
                @if ( $index == 9 )
                  <option value="{{ $index }}" selected> {{ $name }} </option>
                @else
                  <option value="{{ $index }}"> {{ $name }} </option>
                @endif
              @else
                @if ( $index == $requestD->selMaintenanceRate )
                  <option value="{{ $index }}" selected> {{ $name }} </option>
                @else
                  <option value="{{ $index }}"> {{ $name }} </option>
                @endif
              @endempty
            @endforeach
          </select>
          <p>%</p>
        </div>

        <div class="form-inline">
          <label class="col-sm-3 control-label">スワップポイント（IG証券）</label>
          <text  class="col-sm-3 "></text>
          <p>円</p>
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
        <text  class="col-sm-3 ">aaa</text>
      </div>
    @endempty
  @endisset

</div>

@section('scripts')

@endsection

@endsection
