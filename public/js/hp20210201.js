// 表示領域の設定
function chart(data){
  var margin = {top: 20, right: 20, bottom: 30, left: 50},
  width = 960 - margin.left - margin.right,
  height = 500 - margin.top - margin.bottom;

  // 日付変換メソッド
  var parseDate = d3.timeParse("%Y-%m-%e");

  // 横軸の設定
  var x = techan.scale.financetime().range([0, width]);

  // 縦軸の設定
  //データの最小値と最大値の間隔の縮尺を一定の割合で調整する
  //.range([描画領域の最小座標,描画領域の最大座標])
  var y = d3.scaleLinear().range([height, 0]);

// ローソク足の設定
  var candlestick = techan.plot.candlestick().xScale(x).yScale(y);

  var xAxis = d3.axisBottom()
  .scale(x)
	.tickFormat(d3.timeFormat("%Y-%-m-%e")) // // "2017-10-25"
	.ticks(5) // 5データずつにメモリ表示;

  var yAxis = d3.axisLeft().scale(y);

  var svg = d3.select("#chartContainer").append("svg")
	.attr("width", width + margin.left + margin.right)
	.attr("height", height + margin.top + margin.bottom)
	.append("g")
	.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

  //確認用。データを受け取らないで描画したいときはonにする。
	// data = [{"Date":"2015-01-05","Open":17325.7,"High":17540.9,"Low":17219.2,"Close":17408.7,"Volume":873},
	// {"Date":"2015-01-06","Open":17101.6,"High":17111.4,"Low":16881.7,"Close":16883.2,"Volume":145},
	// {"Date":"2015-01-07","Open":16808.3,"High":16974.6,"Low":16808.3,"Close":16885.3,"Volume":841},
	// {"Date":"2015-01-08","Open":17067.4,"High":17243.7,"Low":17016.1,"Close":17167.1,"Volume":294},
	// {"Date":"2015-01-09","Open":17318.7,"High":17342.7,"Low":17129.5,"Close":17197.7,"Volume":176},
	// {"Date":"2015-01-13","Open":16970.9,"High":17087.7,"Low":16828.3,"Close":17087.7,"Volume":148},
	// {"Date":"2015-01-14","Open":16961.8,"High":17036.7,"Low":16770.6,"Close":16796,"Volume":860},
	// {"Date":"2015-01-15","Open":16872.9,"High":17142,"Low":16856.2,"Close":17108.7,"Volume":206},
	// {"Date":"2015-01-16","Open":16813,"High":16864.3,"Low":16592.6,"Close":16864.2,"Volume":446},
	// {"Date":"2015-01-19","Open":17000.8,"High":17039.8,"Low":16911.6,"Close":17014.3,"Volume":476},
	// {"Date":"2015-01-20","Open":17071.7,"High":17366.3,"Low":17066.8,"Close":17366.3,"Volume":799}]

		// 日時で並び替えを行う
		var accessor = candlestick.accessor();

    console.log(data.length);
    console.log(data);
		//こいつはデータを抽出・並べ替えしているだけ。
		data = data.map(function(d) {
				return {
						date: parseDate(d.Date),
						open: +d.Open,
						high: +d.High,
						low: +d.Low,
						close: +d.Close,
						volume: +d.Volume
				};
		}).sort(function(a, b) { return d3.ascending(accessor.d(a), accessor.d(b)); });
	  console.log(data);

		// ページに要素を追加していく(.append＝jQueryでの要素追加。"g"のclass=candelstickを追加)
		svg.append("g")
						.attr("class", "candlestick");

		svg.append("g")
						.attr("class", "x axis")
						.attr("transform", "translate(0," + height + ")");

		svg.append("g")
						.attr("class", "y axis")
						.append("text")
						.attr("transform", "rotate(-90)") // Y軸ラベルを縦書きに
						.attr("y", 6)
						.attr("dy", ".71em")
						.style("text-anchor", "end")
						.text("価格（＄）");

		x.domain(data.map(candlestick.accessor().d));
		y.domain(techan.scale.plot.ohlc(data, candlestick.accessor()).domain());

		svg.selectAll("g.candlestick").datum(data).call(candlestick);
		svg.selectAll("g.x.axis").call(xAxis);
		svg.selectAll("g.y.axis").call(yAxis);
		console.log(data);
}

chart(data);
