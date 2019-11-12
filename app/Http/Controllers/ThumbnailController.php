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

        $store_temp_path = 'public/temp/thumbnail';

        $temp_path = $imagefile->store($store_temp_path);
        $filename = str_replace($store_temp_path . '/', '', $temp_path);
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

        dump(round($width));
        dump(round($height));
        dump(round($x));
        dump(round($y));

        // session の data を初期化
//        $request->session()->forget('data');

        $crop_img = Image::make($preview_img);
        $crop_img
            ->crop(
                round($width),
                round($height),
                round($x),
                round($y))
            ->resize(100,100)
            ->save($preview_img);

        $request->session()->put('data', $data);

        return view('users/thumbnail/confirm', compact('data'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->session()->get('data');
        $store_path = 'public/thumbnail';
        $store_temp_path = 'public/temp/thumbnail';
        dump($data);

        $store_img = str_replace($store_temp_path, $store_path, $data['temp_path']);
        dump($store_img);

        dump($data['temp_path']);

        Storage::move($data['temp_path'], $store_img);

        $user->thumbnail = $data['filename'];
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'サムネイルを変更しました！');
    }
}
