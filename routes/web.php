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
    Route::post('/photos/delete/{photo}', 'PhotosController@destroy')->name('photos.destroy');
    // 投稿画像入力フォーム
    Route::get('/photos/create', 'PhotosController@create')->name('photos.create');
    // 投稿画像確認
    Route::post('/photos/create_confirm', 'PhotosController@confirm')->name('photos.confirm');
    // 投稿画像保存処理
    Route::post('/photos/create_complete', 'PhotosController@store')->name('photos.store');
    // 投稿画像編集フォーム
    Route::get('/photos/edit/{photo}', 'PhotosController@edit')->name('photos.edit');
    // 投稿画像編集処理
    Route::post('/photos/edit/{photo}', 'PhotosController@update')->name('photos.update');

// User
    // 登録情報編集フォーム
    Route::get('/mypage/edit', 'UsersController@edit')->name('users.edit');
    // 編集内容確認
    Route::post('/mypage/edit_confirm/{user}', 'UsersController@confirm')->name('users.confirm');
    // 登録情報編集処理
    Route::post('/mypage/edit_complete/{user}', 'UsersController@update')->name('users.update');

// Profile
    // プロフィール編集フォーム
    Route::get('/mypage/profile/edit', 'ProfileController@edit')->name('profile.edit');
    // 編集内容確認
    Route::post('/mypage/profile/edit_confirm/{user}', 'ProfileController@confirm')->name('profile.confirm');
    // 登録情報編集処理
    Route::post('/mypage/profile/edit_complete/{user}', 'ProfileController@update')->name('profile.update');
});

// Thumbnail
    // サムネイル画像のアップロード
    Route::get('/mypage/thumbnail/edit', 'ThumbnailController@edit')->name('thumbnail.edit');
    // サムネイル画像の加工
    Route::post('/mypage/thumbnail/crop/{user}', 'ThumbnailController@crop')->name('thumbnail.crop');
    // 加工後の画像の確認
    Route::post('/mypage/thumbnail/edit_confirm/{user}', 'ThumbnailController@confirm')->name('thumbnail.confirm');
    // サムネイル保存処理
    Route::post('/mypage/thumbnail/edit_complete/{user}', 'ThumbnailController@update')->name('thumbnail.update');

// Search
    // 自分の投稿
    Route::get('/photos/mypost', 'SearchController@mypost')->name('search.mypost');
    // タグの検索
    Route::get('/photos/explore/tags/{tag}', 'SearchController@tag')->name('search.tag');
    // ユーザーの検索
    Route::get('/photos/explore/users/{user}', 'SearchController@user')->name('search.user');

Auth::routes();

