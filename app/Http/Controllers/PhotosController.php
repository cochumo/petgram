<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotosRequest;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    // 読み込むパス
    public $read_img_path = "storage/photos/";
    // 保存されるパス
    public $save_img_path = "public/photos/";

    /**
     * 投稿一覧表示
     */
    public function index()
    {
        // 投稿を取得
        $photos = Photo::latest()->get();

        return view('photos/index', [
            'photos' => $photos,
            'read_img_path' => $this->read_img_path,
        ]);
    }

    /**
     * 投稿詳細表示
     */
    public function showPostDetail($id)
    {
        // 詳細を表示する投稿を取得
        $photo = Photo::find($id);

        return view('photos/detail', [
           'photo' => $photo,
           'read_img_path' => $this->read_img_path,
        ]);
    }

    /**
     * 投稿削除
     */
    public function delete($id){
        // 削除する投稿を取得
        $photo = Photo::find($id);
//        dump($id);
//        dump($photo->filename);
//        dd($photo);

        // 該当の投稿の画像を削除
        Storage::disk('local')->delete($this->save_img_path . $photo->filename);

        // レコードの削除
        $photo->delete();

        return redirect('/photos');
    }

    /**
     * 投稿入力フォーム
     */
    public function showCreateForm()
    {
        return view('photos/create');
    }

    /**
     * 投稿確認画面
     */
    public function confirm(PhotosRequest $request)
    {
//        dd($request);

        $imagefile = $request->file('photo');

//        dd($imagefile);

        // 保存した時に生成した一意なファイル名とパス
        $temp_path = $imagefile->store('public/temp');
        // 一意なファイル名
        $filename = str_replace('public/temp/', '', $temp_path);
        // 表示の際に読むファイル名とパス
        $read_temp_path = str_replace('public/', 'storage/', $temp_path);

//        dd($read_temp_path);

        $data = array(
            'temp_path' => $temp_path,
            'read_temp_path' => $read_temp_path,
            'filename' => $filename,
        );

        $request->session()->put('data', $data);


        return view('photos/create_confirm', compact('data'));
    }

    /**
     * 投稿保存
     */
    public function create(Request $request)
    {
        // session の data を取得
        $data = $request->session()->get('data');

        // 初期化する前に変数へ代入
        $temp_path = $data['temp_path'];
        $read_temp_path = $data['read_temp_path'];
        $filename = $data['filename'];

        // 保存されるパス + ファイル名
        $storage_path = $this->save_img_path . $filename;
//        dump($storage_path);

        // session の data を初期化
        $request->session()->forget('data');

        // 一時保存場所から移動
        Storage::move($temp_path, $storage_path);

        // 読み込むパス + ファイル名
        $read_path = str_replace($this->save_img_path, $this->read_img_path, $storage_path);
//        dd($read_path);

        $photo = new Photo();

        $photo->user_id = 1; // 暫定
        $photo->filename = $filename;
        $photo->save();

        return redirect('/photos');
    }
}
