<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Photo;

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
    public function confirm()
    {

    }

    /**
     * 登録情報の編集処理
     */
    public function update(Request $request, User $user)
    {
        //
    }
}

