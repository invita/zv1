<?php

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

//Route::get('/', function () {
    //return view('index');
    //return redirect()->action('IndexController@index');
//});

Route::get('/', 'IndexController@index');
Route::get('/chart', 'ChartController@index');

Route::post('/api', 'ApiController@index');
Route::post('/api/search', 'ApiController@search');
Route::post('/api/dictionary', 'ApiController@dictionary');

Route::get('/api/reindex', 'ApiController@reindex');

Route::get('/file/zrtevPdf', 'FileController@zrtevPdf');

