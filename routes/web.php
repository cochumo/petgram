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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {

// photos
    // 一覧表示
    Route::get('/photos', 'PhotosController@index')->name('photos.index');
    // 個別投稿
    Route::get('/photos/post/{photo}', 'PhotosController@show')->name('photos.show');
    // 投稿削除
    Route::post('/photos/delete/{photo}', 'PhotosController@destroy');
    // 入力フォーム
    Route::get('/photos/create', 'PhotosController@create')->name('photos.create');
    // 確認画面
    Route::post('/photos/create_confirm', 'PhotosController@confirm')->name('photos.confirm');
    // 保存
    Route::post('/photos/create_complete', 'PhotosController@store');
    // 編集フォーム
    Route::get('/photos/edit/{photo}', 'PhotosController@edit')->name('photos.edit');
    // 編集処理
    Route::post('/photos/edit/{photo}', 'PhotosController@update');

});

Auth::routes();

