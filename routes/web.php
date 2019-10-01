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


// photos
    // 一覧表示
    Route::get('/photos', 'PhotosController@index');
    // 投稿削除
    Route::post('/photos/delete/{id}', 'PhotosController@delete');
    // 入力フォーム
    Route::get('/photos/create', 'PhotosController@showCreateForm')->name('photos.create');
    // 確認画面
    Route::post('/photos/create_confirm', 'PhotosController@confirm');
    // 保存
    Route::post('/photos/create_complete', 'PhotosController@create');

