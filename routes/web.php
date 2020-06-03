<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ルート、welcome画面
Route::get('/', 'PostsController@index');
// Route::get('/posts/{id}', 'PostsController@show');
//ブログ一覧画面
Route::get('/blog', 'PostsController@blog');
//ブログ個別ページ
Route::get('/blog/{id}','PostsController@blogDetail');
Route::post('/blog/{id}','PostsController@blogDetailP');

//DB更新用の処理（一覧）
Route::get('/admin', 'AdminController@update');
//DB更新用の処理（ボタン押下時）
Route::post('/import/{kbn}', 'AdminController@import')->name('csvimport_import');






// pythonの呼び出し用処理
// 使わなそうだけどまだとっておく。
Route::post('/python', 'ExecController@executePython');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
