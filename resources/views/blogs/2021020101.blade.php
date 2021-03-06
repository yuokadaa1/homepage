@extends('layouts.default')

@section('title', '日本株式のドル価')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item"><a href="/blog">更新ブログ一覧</a></li>
    <li class="breadcrumb-item">日本株式のドル価</li>
  </ol>
</nav>

<div class="container mb-4" id="ZERO">
  <h3>日本株式のドル価</h3>
  <form method="post" action="{{ url('/blog/2021020101') }}">
  	{{ csrf_field() }}

    <div class="box container mb-4" data-formno="0" style="border:dashed 1px #ccc">
      <li>
        <a class="no">1</a>
        <a>
          <input type="text" name="tseCode" class="namae" placeholder="東証コードの入力" value="{{ old('title') }}">
          @if ($errors->has('title'))
            <span class="error">{{ $errors->first('title') }}</span>
          @endif
        </a>
      </li>
    </div>

    <div class="container mb-4">
    	<p>
    		<!-- {{ Form::radio('selectButton', '1', true, array('id' => '111')) }} {{ Form::label('111', '表示期間の選択：直近期間を指定') }} -->
        {{ Form::label('111', '表示期間の選択：表示する期間を指定') }}
    	</p>
      <p class="container ml-4">
    		{{ Form::radio('selectDays', '1', true, array('id' => '300days')) }} {{ Form::label('1Month', '300日') }}
    		{{ Form::radio('selectDays', '2', false, array('id' => '1Year')) }} {{ Form::label('1Year', '1年') }}
    		{{ Form::radio('selectDays', '3', false, array('id' => '2Year')) }} {{ Form::label('2Year', '2年') }}
    		{{ Form::radio('selectDays', '4', false, array('id' => '3Year')) }} {{ Form::label('3Year', '3年') }}
    		{{ Form::radio('selectDays', '5', false, array('id' => '4Year')) }} {{ Form::label('4Year', '4年') }}
        {{ Form::radio('selectDays', '6', false, array('id' => '5Year')) }} {{ Form::label('5Year', '5年') }}
    	</p>

    	<!-- <p>
    		{{ Form::radio('selectButton', '2', false, array('id' => '112')) }} {{ Form::label('112', '表示期間の選択：日付を指定') }}
    	</p>

    	<div class="container ml-4 form-group row mb-0">
        <label for="text3a" class="col-form-label">開始</label>
        <div class="col-sm-4">
          <input type="text" id="pickerStart" class="form-control" placeholder="年/月/日">
        </div>
      </div>
      <div class="container ml-4 form-group row mb-0">
        <label for="text3a" class="col-form-label">終了</label>
        <div class="col-sm-4">
          <input type="text" id="pickerStart" class="form-control" placeholder="年/月/日">
        </div>
      </div> -->

    </div>

    <p>
      <input type="submit" value="Search">
    </p>
  </form>
</div>

@isset( $json )
  <script src="https://d3js.org/d3.v5.min.js"></script>
  <script src="http://techanjs.org/techan.min.js"></script>
  <script>
    var data = JSON.parse('<?php echo $json; ?>');
  </script>

  <div id="chartContainer"></div>
	<link rel="stylesheet" href="/css/hp20210201.css">
	<script src="/js/hp20210201.js"></script>
@endisset

@endsection
