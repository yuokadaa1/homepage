<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\import_csv;
use App\Post;
use App\Index;
use App\Meigara;
use Illuminate\Support\Facades\DB;


class PostsController extends Controller
{
    public function index() {
      return view('welcome');
    }

    public function blog() {
      return view('posts.index');
    }

    public function blogDetail($id) {

      switch ($id) {
        case "2020041001":
          $arrayData = $this->b2020041001();
          return view('blogs.' . $id)->with('json',$arrayData);
        default:
          return view('blogs.' . $id);
      }

    }

    private function b2020041001(){

      //①日銀のETF買いを取得（1306の12:30に結合）
      $indexData = DB::table('indices')
      ->select(DB::raw(' `index` as meigaraCode,date,"" as time,openingPrice,closingPrice,highPrice,lowPrice,"" as volume,"" as startPrice,beforeRatio,beforeRatioP,"" as ETF '));

      // なぜか　始まり値　＜　終値　のwhere を居れるとバグるのでviwe で実行
      $test = DB::table('meigaras as m1')
      ->select(DB::raw('m1.meigaraCode,m1.date,m1.time,m1.openingPrice,m1.closingPrice,m1.highPrice,m1.lowPrice,m1.volume,m2.openingPrice as startPrice,"" as beforeRatio,"" as beforeRatioP,gpifs.ETF'))
      ->leftjoin('meigaras as m2', function($join){
        $join->on('m1.date','=','m2.date')
              ->where('m2.time','=','09:00:00');
      })
      ->leftjoin('gpifs', 'm1.date', '=', 'gpifs.date')
      ->where('m1.time','=','09:00:00')
      ->orwhere('m1.time','=','12:30:00')
      ->orwhere('m1.time','=','14:30:00')
      ;

      $indexData2 = $indexData
      ->where('date','>=','2020-02-24')
      ->union($test)
      ->orderby('date','asc')
      ->orderby('meigaraCode','ASC')
      ->orderby('time','asc')
      ->get();

      // dd($indexData2);



      // $GPIFData = DB::table('meigaras')
      // ->select(DB::raw('meigaras.meigaraCode,meigaras.date,meigaras.time,openingPrice,closingPrice,highPrice,lowPrice,meigaras.volume,"" as beforeRatio,"" as beforeRatioP,gpifs.ETF'))
      // ->where('meigaras.time', '=', '12:30:00')
      // ->leftjoin('gpifs', 'meigaras.date', '=', 'gpifs.date');
      // // ->limit(10)
      // // ->get();
      // // dd($GPIFData);
      //
      //
      // //②1306のopenとcloseを取得
      // $meigaraData = DB::table('meigaras')
      // ->select(DB::raw(' meigaraCode,date,time,openingPrice,closingPrice,highPrice,lowPrice,volume,"" as beforeRatio,"" as beforeRatioP,"" as ETF '))
      // ->where('time', '09:00:00')
      // ->orwhere('time', '14:30:00');
      //
      // //③DOWの値を取得して①と②と結合
      // $indexData = DB::table('indices')
      // ->select(DB::raw(' `index` as meigaraCode,date,"" as time,openingPrice,closingPrice,highPrice,lowPrice,"" as volume,beforeRatio,beforeRatioP,"" as ETF '))
      // ->where('date','>=','2020-02-24')
      // ->union($meigaraData)
      // ->union($GPIFData)
      // ->orderby('date','asc')
      // ->orderby('meigaraCode','ASC')
      // ->orderby('time','asc')
      // ->get();
      //
      // dd($indexData);
      //
      //
      // //⑤opening時刻よりも10円以上高い高値があるものを取得
      // $highHigher = DB::select('
      //   select date,time,"highPrice" as highHigher
      //   from meigaras s1
      //   where  highPrice + 10> (select openingPrice from meigaras as s2 where  s2.time = "9:00:00" and s1.date = s2.date)
      // ');
      //
      // dd($highHigher);
      //


      return $indexData2;
    }







// 以降コピー元の処理

    // public function show($id) {
    public function show(Post $post) {
      // $post = Post::find($id);
      // $post = Post::findOrFail($id);
      return view('posts.show')->with('post', $post);
    }

    public function create() {
      // $post = Post::find($id);
      // $post = Post::findOrFail($id);
      return view('posts.create');
    }

    public function store(PostRequest $request) {
      // $this->validate($request,[
      //   'title' => 'required|min:3',
      //   'body' => 'required'
      // ]);
      $post = new Post();
      $post->title = $request->title;
      $post->body = $request->body;
      $post->save();
      return redirect('/');
    }

    public function edit(Post $post) {
      return view('posts.edit')->with('post', $post);
    }

    public function update(PostRequest $Request,Post $post) {
      // $this->validate($request,[
      //   'title' => 'required|min:3',
      //   'body' => 'required'
      // ]);
      $post->title = $request->title;
      $post->body = $request->body;
      $post->save();
      return redirect('/');
    }

    public function destroy(Post $post){
      $post->delete();
      return redirect('/');
    }

}
