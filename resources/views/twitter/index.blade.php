@extends('layouts.default')

@section('title', 'Twitterの検索')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">TOP</a></li>
    <li class="breadcrumb-item">Twitterの検索</li>
  </ol>
</nav>


<div class="container mb-4" id="1st">

  <h5>URLから検索する場合</h5>
  <div class="container">
    <form method="post" action="{{ url('/twitter/search') }}">
      {{ csrf_field() }}
      <div class="form-group">

        <div class="form-inline">
          <label class="col-sm-3 control-label">URL</label>
          @isset( $inputURL )
            <input type="text" name="searchURL" class="col-sm-4 form-control" value={{ $inputURL }}>
          @else
            <input type="text" name="searchURL" class="col-sm-4 form-control">
          @endisset
        </div>

        <input type="submit" name="button3" value="URLで検索" class="btn btn-success btn-wide" />

      </div>
    </form>
  </div>

  @isset( $getTweets )
  <h5>検索結果</h5>

    <a>取得件数(original/conversation/retweet) = {{ $getTweets->countO }} / {{ $getTweets->countC }} / {{ $getTweets->countR }}</a>
    <div class="container">
      <table class="table table-hover-responsive">
        <tr class="thead-dark">
          <th rowspan="2" valign="middle">No.</th>
          <th valign="middle">日時</th>
          <th>本文</th>
          <!-- <th>name</th> -->
          <th>URL</th>
          <th>copy</th>
        </tr>
        <tr class="thead-dark">
          <th>type</th>
          <th>翻訳</th>
          <th>URL</th>
          <th>copy</th>
        </tr>
        <tr class="thead-white">
          <th></th>
          <th>検索元</th>
          <th></th>
          <th></th>
          <th>
            <input type="button" name="getURLInput" value="URL" class="btn btn-success btn-wide"
            onclick="copyTextToClipboard( '{{ $inputURL }}' )" />
          </th>
          <th></th>
        </tr>
        @foreach ($getTweets->statuses  as $idx => $getTweet)
          <tr>
            <td rowspan="2" valign="middle">{{ $idx }}</td>
            <td>{{ $getTweet->created_at }}</td>
            <td>{{ $getTweet->text }}</td>
            <td>
              <input type="button" name="getURL{{$idx}}" value="URL" class="btn btn-success btn-wide"
              onclick="copyTextToClipboard( {{ $idx }}  )" />
            </td>
            <td>
              <input name="checkBox{{$idx}}" type="checkbox" value="{{$idx}}" >
            </td>
          </tr>
          <tr>
            <td>{{ $getTweet->searchType }}</td>
            <td id="textJp{{$idx}}">{{ $getTweet->textJp }}</td>
            <td>
              <input type="button" name="getText{{$idx}}" value="TEXT" class="btn btn-success btn-wide"
              onclick="copyTextToClipboardT( {{ $idx }}  )" />
            </td>
            <td>
              <input name="checkBoxT{{$idx}}" type="checkbox" value="{{$idx}}" >
            </td>
          </tr>
          <input type="hidden" name="userid{{$idx}}" value="{{ $getTweet->id }}">
          <input type="hidden" name="username{{$idx}}" value="{{ $getTweet->username }}">
          <!-- getTweet->user->username 項目絞らない判を使用する場合は左にする必要がある。-->
        @endforeach
      </table>
    </div>
  @endisset

  <script>

    function copyTextToClipboardT(textVal){
      // 検索wordの取得時にはtextValにはURLが、リツイートの時はtextValにはAPIの返り値が格納
      console.log("URLのほうが押されました");

      // hidden属性のURLをcopyしてクリップボードに貼り付け
      var copyFrom = document.createElement("textarea");
      var textJp = document.getElementById("textJp" + textVal);
      copyFrom.textContent = textJp.innerText;

      var bodyElm = document.getElementsByTagName("body")[0];
      bodyElm.appendChild(copyFrom);
      copyFrom.select();
      var retVal = document.execCommand('copy');
      bodyElm.removeChild(copyFrom);

      if( Number.isFinite(textVal) ){
        // 押したボタンだけを info に 他のボタンはsucess に塗り替える。
        for (let i = 0 ; i < 100 ; i++) {
          if ( i == textVal ){
            document.getElementsByName("getText" + i)[0].className = "btn btn-primary btn-wide";
          } else if( document.getElementsByName("getText" + i)[0] != null ){
            document.getElementsByName("getText" + i)[0].className = "btn btn-success btn-wide";
          } else {
            i = 100;
          }
        }
        // checkboxをcheckedに変更
        document.getElementsByName("checkBoxT" + textVal)[0].checked  = "true";
      }

      // 処理結果を返却
      return retVal;
    }

    function copyTextToClipboard(textVal){
      // 検索wordの取得時にはtextValにはURLが、リツイートの時はtextValにはAPIの返り値が格納
      // console.log("TEXTJzpのほうが押されました");

      // hidden属性のURLをcopyしてクリップボードに貼り付け
      var copyFrom = document.createElement("textarea");

      if( Number.isFinite(textVal) ){
        // copy用URLの生成
        username = document.getElementsByName("username" + textVal).item(0).value
        userid = document.getElementsByName("userid" + textVal).item(0).value;
        // 純粋にURLを作るだけならこれでよい。
        // copyFrom.textContent = "https://twitter.com/" + username + "/status/" + userid;
        twitterurl = "https://twitter.com/" + username + "/status/" + userid;
      }else{
        twitterurl = textVal;
      }
      // リプライ元を非表示に設定したURLの生成
      if(textVal == 0){
        copyFrom.textContent = '<figure class="wp-block-embed-twitter wp-block-embed is-type-rich is-provider-twitter"><div class="wp-block-embed__wrapper"><blockquote class="twitter-tweet" data-conversation="none">\r\n' + twitterurl + '\r\n</blockquote></div></figure>';
      }else{
        // 右側に設定することでリプライであることを表現する。
        copyFrom.textContent = '<div align="right"><figure class="wp-block-embed-twitter wp-block-embed is-type-rich is-provider-twitter"><div class="wp-block-embed__wrapper"><blockquote class="twitter-tweet" data-conversation="none">\r\n' + twitterurl + '\r\n</blockquote></div></figure></div>';
      }

      // copyFrom.textContent = '<figure class="wp-block-embed-twitter wp-block-embed is-type-rich is-provider-twitter"><div class="wp-block-embed__wrapper"><blockquote class="twitter-tweet" data-conversation="none">\r\n' + twitterurl + '\r\n</blockquote></div></figure>';

      var bodyElm = document.getElementsByTagName("body")[0];
      bodyElm.appendChild(copyFrom);
      copyFrom.select();
      var retVal = document.execCommand('copy');
      bodyElm.removeChild(copyFrom);

      if( Number.isFinite(textVal) ){
        // 押したボタンだけを info に 他のボタンはsucess に塗り替える。
        for (let i = 0 ; i < 100 ; i++) {
          if ( i == textVal ){
            document.getElementsByName("getURL" + i)[0].className = "btn btn-primary btn-wide";
          } else if( document.getElementsByName("getURL" + i)[0] != null ){
            document.getElementsByName("getURL" + i)[0].className = "btn btn-success btn-wide";
          } else {
            i = 100;
          }
        }

        // checkboxをcheckedに変更
        document.getElementsByName("checkBox" + textVal)[0].checked  = "true";
      }

      // 処理結果を返却
      return retVal;
    }
  </script>

</div>


@section('scripts')

@endsection

@endsection
