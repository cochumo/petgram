<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * 登録情報の編集フォーム
     */
    public function edit()
    {
        $user = auth()->user();
//        dd($user);

        return view('users/info_edit', [
            'user' => $user,
        ]);
    }

    /**
     * 編集内容の確認
     */
    public function confirm(Request $request, User $user)
    {
        // formのuser_idが入る箇所を編集して送信した場合の処理
        if (!(auth()->user()->id == $user->id)) {
            return redirect('/photos')->with('success', '指定されたリンクは無効です。');
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required'
        ]);


    }

    /**
     * 登録情報の編集処理
     */
    public function update(Request $request, User $user)
    {
        //
    }
}

