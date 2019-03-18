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

Route::get('/', 'IndexController@index');
Route::get('/search', 'SearchController@index');
Route::get('/zrtev', 'ZrtevController@index');
Route::get('/chart', 'ChartController@index');

Route::post('/api', 'ApiController@index');
Route::post('/api/search', 'ApiController@search');
Route::post('/api/dictionary', 'ApiController@dictionary');

Route::get('/api/reindex', 'ApiController@reindex');

Route::get('/zrtevPdf', 'FileController@zrtevPdf');

