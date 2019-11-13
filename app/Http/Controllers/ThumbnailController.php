<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ThumbnailRequest;
use App\User;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ThumbnailController extends Controller
{
    public function edit()
    {
        return view('users/thumbnail/upload');
    }

    public function crop(ThumbnailRequest $request, User $user)
    {
        // formのuser_idが入る箇所を編集して送信した場合の処理
        if (!(auth()->user()->id == $user->id)) {
            return redirect('/photos')->with('success', '指定されたリンクは無効です。');
        }

        $input = $request->all();
        $imagefile = $request->file('thumbnail');
//        dd($imagefile);

        $store_temp_path = 'public/temp/thumbnail';

        $temp_path = $imagefile->store($store_temp_path);
        $filename = str_replace($store_temp_path . '/', '', $temp_path);
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
        ];

        $request->session()->put('data', $data);

        return view('users/thumbnail/crop', compact('data'));
    }

    public function confirm(Request $request)
    {
        $input = $request->all();
        $data = $request->session()->get('data');
//        dump($data);
//        dump($input);
//        dump($request->get('width'));
//        dump($request->get('height'));
//        dump($request->get('x'));
//        dump($request->get('y'));

        $temp_path = $data['temp_path'];
        $preview_img = $data['preview_img'];
        $filename = $data['filename'];

        $x = $input['x'];
        $y = $input['y'];
        $width = $input['width'];
        $height = $input['height'];

        $imagick = Image::make($preview_img);
        $imagick->getCore()->autoOrient();

        $crop_img = Image::make($preview_img);
        $crop_img
            ->crop(
                round($width),
                round($height),
                round($x),
                round($y))
            ->resize(200,200)
            ->save($preview_img);

        $request->session()->put('data', $data);

        return view('users/thumbnail/confirm', compact('data'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->session()->get('data');
        $store_path = 'public/thumbnail';
        $store_temp_path = 'public/temp/thumbnail';
//        dump($data);

        $store_img = str_replace($store_temp_path, $store_path, $data['temp_path']);
//        dump($store_img);
//
//        dump($data['temp_path']);

        Storage::move($data['temp_path'], $store_img);

        $user->thumbnail = $data['filename'];
        $user->save();

        // session の data を初期化
        $request->session()->forget('data');

        return redirect()->route('profile.edit')->with('success', 'サムネイルを変更しました！');
    }
}
