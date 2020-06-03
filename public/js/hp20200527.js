
// プルダウンにより通貨ペアが変更された場合、
document.getElementById("selectPair").onchange = function() {
  /*
   * obj は select タグであり、selectedIndex プロパティには
   * 変更後の選択項目のインデックスが格納されています
   */
  // 0:USDJPY,1:USDKRW,2:GBPUSD,3:GBPJPY
  var stepRate = [0.001,0.01,0.00001,0.001]
  var changeSelect = document.getElementById("selectPair").value - 1;
  document.getElementById("inputRate").value = data[changeSelect]["price"];
  document.getElementById("inputRate").step = stepRate[changeSelect];
}

document.getElementById("netAssets").onFocus = function() {
  document.getElementById("netAssets").type = "text";
  var value = document.getElementById("inputRate").value
  document.getElementById("inputRate").value = value.toLocaleString;
}

// と思ったけど別になくてもいいや。リロードせいや。
// document.getElementById("button1").onclick = function() {
  // ここに#buttonをクリックしたら発生させる処理を記述する
//   console.log("aaaaaaaa");
// };
