<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ThumbnailRequest;
use App\User;

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
        dd($input);



        return view('users/thumbnail/confirm');
    }

    public function update()
    {

    }
}
