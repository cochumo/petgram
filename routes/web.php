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
    // 投稿画像一覧表示
    Route::get('/photos', 'PhotosController@index')->name('photos.index');
    // 投稿画像詳細表示
    Route::get('/photos/post/{photo}', 'PhotosController@show')->name('photos.show');
    // 投稿画像削除処理
    Route::post('/photos/delete/{photo}', 'PhotosController@destroy');
    // 投稿画像入力フォーム
    Route::get('/photos/create', 'PhotosController@create')->name('photos.create');
    // 投稿画像確認
    Route::post('/photos/create_confirm', 'PhotosController@confirm')->name('photos.confirm');
    // 投稿画像保存処理
    Route::post('/photos/create_complete', 'PhotosController@store');
    // 投稿画像編集フォーム
    Route::get('/photos/edit/{photo}', 'PhotosController@edit')->name('photos.edit');
    // 投稿画像編集処理
    Route::post('/photos/edit/{photo}', 'PhotosController@update');

// User
    // 登録情報編集フォーム
    Route::get('/mypage/edit', 'UsersController@edit')->name('users.edit');
    // 編集内容確認
    Route::post('/mypage/edit_confirm/{user}', 'UsersController@confirm')->name('users.confirm');
    // 登録情報編集処理
    Route::post('/mypage/edit_complete/{user}', 'UsersController@update');

});

Auth::routes();

