<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;

class UsersController extends Controller
{
    /**
     * 登録情報の編集フォーム
     */
    public function edit(Request $request)
    {
        $user = auth()->user();

        return view('users/edit', [
            'user' => $user,
        ]);
    }

    /**
     * 編集内容の確認
     */
    public function confirm(UserRequest $request, User $user)
    {
        // formのuser_idが入る箇所を編集して送信した場合の処理
        if (!(auth()->user()->id == $user->id)) {
            return redirect('/photos')->with('success', '指定されたリンクは無効です。');
        }

        $input = $request->all();

        $data = [
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['new_password'],
            'password_face' => str_repeat('*', strlen($input['new_password'])),
        ];

        $request->session()->put('data', $data);

        return view('users/edit_confirm', compact('data'));

    }

    /**
     * 登録情報の編集処理
     */
    public function update(Request $request, User $user)
    {
        // 確認画面で戻るボタンが押された場合の処理
        if ($request->get('action') === 'back') {
            // 入力画面へ戻る
            return redirect()->route('users.edit');
        }

        $data = $request->session()->get('data');

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        $request->session()->forget('data');

        return redirect()->route('photos.index')->with('success', 'アカウント情報を変更しました！');
    }
}

