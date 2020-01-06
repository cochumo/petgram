<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhotosMessageRequest;
use App\Http\Requests\PhotosRequest;
use App\Photo;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\Imagick;

class PhotosController extends Controller
{
    private $photo;

    // DIでPhotoモデルをインスタンス化

    /**
     * PhotosController constructor.
     * @param Photo $photo
     */
    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }


    /**
     * 投稿一覧表示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // 投稿を取得
//        $photos = Photo::latest()->get();
        $photos = Photo::latest()->simplePaginate(24);
//        dd($photos);

        return view('photos/index', [
            'photos' => $photos,
        ]);
    }

    /**
     * 投稿詳細表示
     * @param Photo $photo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Photo $photo)
    {
        $photo = $photo->getPhoto($photo->id);
        $user = Auth::user();

        if ($user->isNotRegisteredAsLoveReacter()) {
            $user->registerAsLoveReacter();
        }
        if ($photo->isNotRegisteredAsLoveReactant()) {
            $photo->registerAsLoveReactant();
        }

        $reacter = $user->getLoveReacter();
        $reactant = $photo->getLoveReactant();

        return view('photos/detail', [
            'photo' => $photo,
            'user' => $user,
            'reacter' => $reacter,
            'reactant' => $reactant,
        ]);
    }

    /**
     * 投稿削除
     * @param Photo $photo
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Photo $photo)
    {
        // 削除する投稿を取得
//        $photo = Photo::find($id);
//        dump($id);
//        dump($photo->filename);
//        dd($photo);

        // 該当の投稿の画像を削除
        Storage::disk('local')->delete(Photo::SAVE_IMG_PATH . $photo->filename);

        // レコードの削除
        $photo->delete();

        return redirect()->route('photos.index')->with('success', '投稿の削除を完了しました！');
    }


    /**
     * 投稿入力フォーム
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $tags = Tag::where('original_flag', 1)->get();

        return view('photos/create', [
            'tags' => $tags,
        ]);
    }

    /**
     * 投稿確認画面
     * @param PhotosRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(PhotosRequest $request)
    {
//        dd($request->validated());

        $input = $request->validated();
        $imagefile = $input['photo'];

        if ($input['message'] == null) {
            $input['message'] = "";
        }

//        dd($input['message']);

        // 保存した時に生成した一意なファイル名とパス
        $temp_path = $imagefile->store(rtrim(Photo::SAVE_TEMP_PATH, '/'));
        // 一意なファイル名
        $filename = str_replace(Photo::SAVE_TEMP_PATH, '', $temp_path);
        // 表示の際に読むファイル名とパス
        $read_temp_path = str_replace('public/', 'storage/', $temp_path);

        $input['tags'] = array_filter($input['tags']);

        if (isset($input['tags']) && is_array($input['tags'])) {
            $tags_name = implode(", ", $input['tags']);
        }

        $data = [
            'temp_path' => $temp_path,
            'read_temp_path' => $read_temp_path,
            'filename' => $filename,
            'tags' => $input['tags'],
            'tags_name' => $tags_name,
            'message' => $input['message'],
        ];

        $request->session()->put('data', $data);

        return view('photos/create_confirm', compact('data'));
    }

    /**
     * 投稿保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // session の data を取得
        $data = $request->session()->get('data');

        // ログインしているuserの情報を取得
        $user = auth()->user();

        // 初期化する前に変数へ代入
        $temp_path = $data['temp_path'];
        $read_temp_path = $data['read_temp_path'];
        $filename = $data['filename'];
        $tags = $data['tags'];
        $message = $data['message'];

        // 保存されるパス + ファイル名
        $storage_path = Photo::SAVE_IMG_PATH . $filename;

        // session の data を初期化
        $request->session()->forget('data');

        // Exif情報正常化
        Imagick::autoOrient($read_temp_path);

        // リサイズ
        Imagick::resize($read_temp_path, 750, 750);

        // 一時保存場所から移動
        Storage::move($temp_path, $storage_path);

        // 画像情報登録処理
        $this->photo->fill([
            'user_id' => $user['id'],
            'filename' => $filename,
            'message' => $message,
        ])->save();

        // 中間テーブル
        $this->photo->tags()->sync(collect($tags)->map(function($tag) {
            return Tag::firstOrCreate(['name' => $tag])->id;
        }));

        return redirect()->route('photos.index')->with('success', '画像の投稿を完了しました！');
    }

    /**
     * 編集フォーム表示
     * @param Photo $photo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Photo $photo)
    {
        return view('photos/edit', [
            'photo' => $photo,
        ]);
    }

    /**
     * 編集処理
     * @param Photo $photo
     * @param PhotosMessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Photo $photo, PhotosMessageRequest $request)
    {
        $user = auth()->user();

        $data = $request->all();

        if ($data['message'] == null) {
            $data['message'] = "";
        }

        // 編集者が投稿者と同じか検査
        if (!($user['id'] == $photo['user_id'])) {
            return redirect()->route('photos.index');
        }

        // メッセージをupdate
        $photo->fill($request->validated())->save();

        return redirect()->route('photos.index')->with('success', '投稿の編集を完了しました！');
    }
}
