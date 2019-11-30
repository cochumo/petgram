<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ThumbnailRequest;
use App\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ThumbnailController extends Controller
{
    /**
     * サムネイルの編集フォーム
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('users/thumbnail/upload');
    }

    /**
     * サムネイルのトリミング
     * @param ThumbnailRequest $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function crop(ThumbnailRequest $request, User $user)
    {
        // formのuser_idが入る箇所を編集して送信した場合の処理
        if (!(auth()->user()->id == $user->id)) {
            return redirect('/photos')->with('success', '指定されたリンクは無効です。');
        }

        $input = $request->validated();
        $imagefile = $input['thumbnail'];
//        dd($imagefile);

        $save_temp_path = User::SAVE_TEMP_PATH;

        $temp_path = $imagefile->store($save_temp_path);
        $filename = str_replace($save_temp_path . '/', '', $temp_path);
        $preview_img = str_replace('public/', 'storage/', $temp_path);

        // ExifのOrientation正常化処理
        $imagick_photo = Image::make($preview_img)->getCore();

        // 画像のプロパティ
        $properties = $imagick_photo->getImageProperties();

        // autoOrient()もgetImageOrientation()も思ったとおりに動かないため、プロパティを見て自分でrotateする処理
        if (isset($properties['exif:Orientation'])) {
            $orientation = $imagick_photo->getImageProperties()['exif:Orientation'];
//            dd($orientation);
            switch ($orientation) {
                case 2:
                    $imagick_photo->flopImage();
                    break;
                case 3:
                    $imagick_photo->rotateImage('#000000', 180);
                    break;
                case 4:
                    $imagick_photo->flipImage();
                    break;
                case 5:
                    $imagick_photo->flopImage();
                    $imagick_photo->rotateImage('#000000', 270);
                    break;
                case 6:
                    $imagick_photo->rotateImage('#000000', 90);
                    break;
                case 7:
                    $imagick_photo->flopImage();
                    $imagick_photo->rotateImage('#000000', 90);
                    break;
                case 8:
                    $imagick_photo->rotateImage('#000000', 270);
                    break;
            }
            //Exif情報を全削除
            $imagick_photo->stripImage();
            //回転させたあとにExifに無回転だと設定
            $imagick_photo->setImageOrientation(1);
            $imagick_photo->writeImage($preview_img);
        }

        $data = [
            'temp_path' => $temp_path,
            'preview_img' => $preview_img,
            'filename' => $filename,
            'crop_flag' => true,
        ];

        $request->session()->put('data', $data);

        return view('users/thumbnail/crop', compact('data'));
    }

    /**
     * トリミングした画像の確認
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(Request $request)
    {
        $input = $request->all();
        $data = $request->session()->get('data');

        $temp_path = $data['temp_path'];
        $preview_img = $data['preview_img'];
        $filename = $data['filename'];

        $x = $input['x'];
        $y = $input['y'];
        $width = $input['width'];
        $height = $input['height'];

        // 2重トリミング防止
        if ($data['crop_flag'] == true) {
            $crop_img = Image::make($preview_img);
            $crop_img
                ->crop(
                    round($width),
                    round($height),
                    round($x),
                    round($y)
                )
                ->resize(200, 200)
                ->save($preview_img);

            $data['crop_flag'] = false;

//        $request->session()->regenerateToken();
        }

//        dump($data);

        $request->session()->put('data', $data);

        return view('users/thumbnail/confirm', compact('data'));
    }

    /**
     * 変更処理
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $data = $request->session()->get('data');
//        $save_path = 'public/thumbnail';
        $save_path = User::SAVE_IMG_PATH;
//        $save_temp_path = 'public/temp/thumbnail';
        $save_temp_path = User::SAVE_TEMP_PATH;

//        dump($data);

        // 確認画面で修正ボタンが押された場合の処理
//        if ($request->get('action') === 'back') {
        // トリミング画面へ戻る
//            return redirect()->route('thumbnail.crop', [$user->id])->withInput($request->session()->get('data'));
//            return back();
//            return redirect()->action('ThumbnailController@crop', ['user' => $user->id])->withInput($request->session()->get('data'));
//        }

        $store_img = str_replace($save_temp_path, $save_path, $data['temp_path']);
//        dump($store_img);
//
//        dump($data['temp_path']);

        Storage::move($data['temp_path'], $store_img);

        // 既にサムネイルが設定してあったらその画像を削除
        if ($user->thumbnail != "") {
            Storage::disk('local')->delete(User::SAVE_IMG_PATH . $user->thumbnail);
        }

        $user->thumbnail = $data['filename'];
        $user->save();

        // session の data を初期化
        $request->session()->forget('data');

        return redirect()->route('profile.edit')->with('success', 'サムネイルを変更しました！');
    }
}
