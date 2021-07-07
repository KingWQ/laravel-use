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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('db')->group(function () {
    //原生
    Route::get('sql/test','DbSqlController@test');
    //查询构造器
    Route::get('query/select','DbQueryController@select');
    Route::get('query/whereUse','DbQueryController@whereUse');
    Route::get('query/addUpdateDelete','DbQueryController@addUpdateDelete');
    //ORM
    Route::get('orm/add','DbOrmController@add');
});


//collection
Route::get('collect/test','CollectController@index');


//spider
Route::get('guzzle/sync','GuzzleController@sync');
Route::get('guzzle/async','GuzzleController@async');
Route::get('guzzle/multi','GuzzleController@multi');
Route::get('guzzle/pool','GuzzleController@pool');
Route::get('guzzle/response','GuzzleController@response');
Route::get('guzzle/param','GuzzleController@param');
Route::get('guzzle/spider','GuzzleController@spider');
Route::get('guzzle/spider1','GuzzleController@spider1');
