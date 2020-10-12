function copyToClipboard() {

  // // コピー対象をJavaScript上で変数として定義する
  // var copyTarget = document.getElementById("copyTarget");
  //
  // // コピー対象のテキストを選択する
  // copyTarget.select();
  //
  // // 選択しているテキストをクリップボードにコピーする
  // document.execCommand("Copy");
  //
  // // コピーをお知らせする
  // alert("コピーできました！ : " + copyTarget.value);

  // テキストエリアを用意する
  var copyFrom = document.createElement("textarea");
  // テキストエリアへ値をセット
  copyFrom.textContent = "URL";

  // テキストエリアの値を選択
  copyFrom.select();
  // コピーコマンド発行
  // var retVal = document.execCommand('copy');
  // 追加テキストエリアを削除
  // bodyElm.removeChild(copyFrom);
  // 処理結果を返却
  // return retVal;

}
