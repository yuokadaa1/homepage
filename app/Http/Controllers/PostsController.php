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

      $GPIFData = DB::table('meigaras')
      ->select(DB::raw('meigaras.meigaraCode,meigaras.date,meigaras.time,"" as openingPrice,"" as closingPrice,"" as highPrice,"" as lowPrice,meigaras.volume,"" as beforeRatio,"" as beforeRatioP,gpifs.ETF'))
      ->where('meigaras.time', '=', '12:30:00')
      ->leftjoin('gpifs', 'meigaras.date', '=', 'gpifs.date');
      // ->limit(10)
      // ->get();
      // dd($GPIFData);

      $meigaraData = DB::table('meigaras')
      ->select(DB::raw(' meigaraCode,date,time,openingPrice,closingPrice,highPrice,lowPrice,volume,"" as beforeRatio,"" as beforeRatioP,"" as ETF '))
      ->where('time', '09:00:00')
      ->orwhere('time', '14:30:00');

      $indexData = DB::table('indices')
      ->select(DB::raw(' `index` as meigaraCode,date,"23:59:59" as time,openingPrice,closingPrice,highPrice,lowPrice,"" as volume,beforeRatio,beforeRatioP,"" as ETF '))
      ->where('date','>=','2020-02-24')
      ->union($meigaraData)
      ->union($GPIFData)
      ->orderby('date','asc')
      ->orderby('time','asc')
      ->get();

      return $indexData;
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
