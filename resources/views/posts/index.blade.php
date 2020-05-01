@extends('layouts.default')

@section('title', '適当ブログ一覧')

@section('content')
<h3>更新ブログ一覧</h3>
<p><span class="label label-danger">HOME</span> -> 更新ブログ一覧</p>

  <div class="container">
    <div class="form-group">
      <p class="text-center bg-info">登録する写真の一番目はサムネイル。</p>
    </div>
  </div>

  <div class="container">
    <div class="form-group">
      <ul>
        <li><a href={{ url("/blog/2020032301") }}>2020/03/22　初心者向けの投資について</a></li>
        <li><a href={{ url("/blog/2020040601") }}>2020/04/06　各国市場のオープン時刻について</a></li>
        <li><a href={{ url("/blog/2020041001") }}>2020/04/10　GPIFの買い入れについて</a></li>
      </ul>
    </div>
  </div>



  <!-- <div class="container">
    <div class="form-group">
      <div class="form-inline box" data-formno="0">
        <label class="col-sm-3 control-label" for="username">登録する写真：</label>
        <lavel class="no">1</lavel>
        <input type="file" id="file" name="input[0]" class="col-sm-4 form-control namae">
        <a class="btn btn-primary addformbox">追加</a>
        <a class="btn btn-warning deletformbox">削除</a>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10 text-center">
      <input type="submit" name="button1" value="送信" class="btn btn-success btn-wide" />
    </div>
  </div> -->

<!-- モデル情報の表示 -->
<!-- <form class="form-horizontal">
  <p class="text-center bg-info">登録済み情報</p>
  <table class="table table-striped">
    <thead>
      <tr><th scope="col">モデルＩＤ</th><th scope="col">モデル名</th><th scope="col">写真数</th></tr>
     </thead>
     <tbody>
     </tbody>
   </table>
</form> -->

@section('scripts')
    <!-- <script src="/js/starter-template.js"></script> -->
@endsection

@endsection
