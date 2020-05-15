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

      $indexData = DB::select(DB::raw('
      SELECT m1.meigaraCode as meigaraCode,
             m1.date AS date,
             m1.time AS time,
             m1.openingPrice as openingPrice,
             m1.closingPrice as closingPrice,
             m1.highPrice as highPrice,
             m1.lowPrice as lowPrice,
             m1.volume as volume,
             m4.openingPrice AS todayOpening,
             m2.closingPrice AS lastClosing,
             m2.date as lastDate,
             m2.time as lastTime,
             gpif.ETF as BOJETF,
             "" as beforeRatio,
             "" as beforeRatioP
      FROM meigaras as m1
      INNER JOIN meigaras as m2
              ON m2.date = (SELECT MAX(m3.date)
                            FROM meigaras as m3
                            WHERE m3.date < m1.date and m3.time = "09:00:00")
                    		  and m2.time = "14:30:00"
      INNER JOIN meigaras as m4
              on m1.date = m4.date
              and m4.time = "09:00:00"
      INNER JOIN gpifs as gpif
              on gpif.date = m1.date
      WHERE m1.time in ("09:00:00","11:00:00","12:30:00","14:30:00")
        and m1.date > "2020-02-24"
      union
      SELECT "index" as meigaraCode,
      		indices.date AS date,
      		indices.time AS time,
              indices.openingPrice as openingPrice,
              indices.closingPrice as closingPrice,
              indices.highPrice as highPrice,
              indices.lowPrice as lowPrice,
              indices.volume as volume,
              "" AS todayOpening,
              "" AS lastClosing,
              "" as lastDate,
              "" as lastTime,
              "" as BOJETF,
              indices.beforeRatio as beforeRatio,
              indices.beforeRatioP as beforeRatioP
      from indices
      where indices.date > "2020-02-24"
      order by date asc,meigaraCode asc,time asc
      '));

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
