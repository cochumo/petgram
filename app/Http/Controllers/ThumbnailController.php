<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ThumbnailRequest;
use App\User;
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

        $store_path = 'public/temp/thumbnail';

        $temp_path = $imagefile->store($store_path);
        $filename = str_replace($store_path . '/', '', $temp_path);
        $preview_img = str_replace('public/', 'storage/', $temp_path);

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
        dump($data);
        dump($input);
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

        // session の data を初期化
//        $request->session()->forget('data');

        $crop_img = Image::make($preview_img);
        dump($crop_img);
//        $crop_img->crop(
//                        $request->get('width'),
//                        $request->get('height'),
//                        $request->get('x'),
//                        $request->get('y')
//                    );
//        $crop_img->resize(300, 200);
        $crop_img->crop(128, 128, 94, 402)->save($preview_img);
        dump($crop_img);
//                    ->crop(
//                        $request->get('width'),
//                        $request->get('height'),
//                        $request->get('x'),
//                        $request->get('y')
//                    )
//                    ->resize(100,100)
//                    ->save($preview_img);

//        dd();

        $request->session()->put('data', $data);

        return view('users/thumbnail/confirm', compact('data'));
    }

    public function update()
    {

    }
}
