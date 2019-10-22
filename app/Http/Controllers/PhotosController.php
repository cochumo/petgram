<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotosRequest;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotosController extends Controller
{
    // 読み込むパス
    const read_img_path = "storage/photos/";
    // 保存されるパス
    const save_img_path = "public/photos/";

    /**
     * 投稿一覧表示
     */
    public function index()
    {
        // 投稿を取得
//        $photos = Photo::latest()->get();
        $photos = Photo::latest()->paginate(10);
//        dd($photos);

        return view('photos/index', [
            'photos' => $photos,
            'read_img_path' => self::read_img_path,
        ]);
    }

    /**
     * 投稿詳細表示
     */
    public function show($id)
    {
        // 詳細を表示する投稿を取得
        $photo = Photo::find($id);

        return view('photos/detail', [
           'photo' => $photo,
           'read_img_path' => self::read_img_path,
        ]);
    }

    /**
     * 投稿削除
     */
    public function destroy($id){
        // 削除する投稿を取得
        $photo = Photo::find($id);
//        dump($id);
//        dump($photo->filename);
//        dd($photo);

        // 該当の投稿の画像を削除
        Storage::disk('local')->delete(self::save_img_path . $photo->filename);

        // レコードの削除
        $photo->delete();

        return redirect('/photos')->with('success', '投稿の削除を完了しました！');
    }

    /**
     * 投稿入力フォーム
     */
    public function create()
    {
        return view('photos/create');
    }

    /**
     * 投稿確認画面
     */
    public function confirm(PhotosRequest $request)
    {
//        dd($request);

        $input = $request->all();
        $imagefile = $request->file('photo');
        if ($input['message'] == null) {
            $input['message'] = "";
        }

//        dd($input['message']);

        // 保存した時に生成した一意なファイル名とパス
        $temp_path = $imagefile->store('public/temp');
        // 一意なファイル名
        $filename = str_replace('public/temp/', '', $temp_path);
        // 表示の際に読むファイル名とパス
        $read_temp_path = str_replace('public/', 'storage/', $temp_path);

//        dd($read_temp_path);

        $data = [
            'temp_path' => $temp_path,
            'read_temp_path' => $read_temp_path,
            'filename' => $filename,
            'message' => $input['message'],
            ];

        $request->session()->put('data', $data);

        return view('photos/create_confirm', compact('data'));
    }

    /**
     * 投稿保存
     */
    public function store(Request $request)
    {
        // session の data を取得
        $data = $request->session()->get('data');
//        dd($data);

        // ログインしているuserの情報を取得
        $user = auth()->user();
//        dd($user['id']);

        // 初期化する前に変数へ代入
        $temp_path = $data['temp_path'];
        $read_temp_path = $data['read_temp_path'];
        $filename = $data['filename'];
        $message = $data['message'];

        // 保存されるパス + ファイル名
        $storage_path = self::save_img_path . $filename;
//        dump($storage_path);

        // session の data を初期化
        $request->session()->forget('data');

        // 読み込むパス + ファイル名
        $read_path = str_replace(self::save_img_path, self::read_img_path, $storage_path);
//        dd($read_path);

        // ExifのOrientation正常化処理
        $minify_photo = Image::make($read_temp_path)->getCore();

        // 画像のプロパティ
        $properties = $minify_photo->getImageProperties();

        // autoOrient()もgetImageOrientation()も思ったとおりに動かないため、プロパティを見て自分でrotateする処理
        if (isset($minify_photo->getImageProperties()['exif:Orientation'])) {
            $orientation = $minify_photo->getImageProperties()['exif:Orientation'];
//            dd($orientation);
            switch ($orientation) {
                case 2:
                    $minify_photo->flopImage();
                    break;
                case 3:
                    $minify_photo->rotateImage('#000000', 180);
                    break;
                case 4:
                    $minify_photo->flipImage();
                    break;
                case 5:
                    $minify_photo->flopImage();
                    $minify_photo->rotateImage('#000000', 270);
                    break;
                case 6:
                    $minify_photo->rotateImage('#000000', 90);
                    break;
                case 7:
                    $minify_photo->flopImage();
                    $minify_photo->rotateImage('#000000', 90);
                    break;
                case 8:
                    $minify_photo->rotateImage('#000000', 270);
                    break;
            }
            //Exif情報を全削除
            $minify_photo->stripImage();
            //回転させたあとにExifに無回転だと設定
            $minify_photo->setImageOrientation(1);
            $minify_photo->writeImage($read_temp_path);
        }

        // 一時保存場所から移動
        Storage::move($temp_path, $storage_path);

        // 登録処理
        $photo = new Photo();

        $photo->user_id = $user['id'];
        $photo->filename = $filename;
        $photo->message = $message;
        $photo->save();

        return redirect('/photos')->with('success', '画像の投稿を完了しました！');
    }

    /**
     * 編集フォーム表示
     */
    public function edit($id)
    {
        // 編集する投稿を取得
        $photo = Photo::find($id);

        return view('photos/edit', [
            'photo' => $photo,
            'read_img_path' => self::read_img_path,
        ]);
    }

    /**
     * 編集処理
     */
    public function update($id, Request $request)
    {
        $user = auth()->user();

        $photo = Photo::find($id);
        $data = $request->all();

        // 編集者が投稿者と同じか検査
        if(!($user['id'] == $photo['user_id'])) {
            return redirect('/photos');
        }

        // メッセージをupdate
        $photo->message = $data['message'];
        $photo->save();

        return redirect('/photos')->with('success', '投稿の編集を完了しました！');
    }
}
