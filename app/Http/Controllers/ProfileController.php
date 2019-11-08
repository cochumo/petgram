<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\User;

class ProfileController extends Controller
{
    /**
     * プロフィールの編集フォーム
     */
    public function edit(Request $request)
    {
        $user = auth()->user();

        return view('users/profile/edit', [
            'user' => $user,
        ]);
    }

    /**
     * プロフィールの編集内容の確認
     */
    public function confirm(ProfileRequest $request, User $user)
    {
        // formのuser_idが入る箇所を編集して送信した場合の処理
        if (!(auth()->user()->id == $user->id)) {
            return redirect('/photos')->with('success', '指定されたリンクは無効です。');
        }

        $input = $request->all();

        if ($input['profile'] == null) {
            $input['profile'] = "";
        }

        $data = [
            'name' => $input['name'],
            'profile' => $input['profile'],
        ];

        $request->session()->put('data', $data);

        return view('users/profile/edit_confirm', compact('data'));

    }

    /**
     * プロフィールの登録情報の編集処理
     */
    public function update(Request $request, User $user)
    {
        // 確認画面で戻るボタンが押された場合の処理
        if ($request->get('action') === 'back') {
            // 入力画面へ戻る
            return redirect()->route('profile.edit')->withInput($request->session()->get('data'));
        }

        $data = $request->session()->get('data');

        $user->name = $data['name'];
        $user->profile = $data['profile'];
        $user->save();

        $request->session()->forget('data');

        return redirect()->route('photos.index')->with('success', 'プロフィールを変更しました！');
    }
}
