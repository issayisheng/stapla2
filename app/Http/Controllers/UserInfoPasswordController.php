<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserInfoPasswordController extends Controller
{
    // password新規登録用
    public function store(Request $request)
    {
        // パスワードのバリデーション
        // 新しいパスワードは8文字以上、confirmフィールドの値と一致しているかどうか。
        $validated_data = $request->validate([
            'newpassword' => ['required','string','confirmed','min:8','regex:/^[a-zA-Z0-9]+$/'], //半角英数字のみ
        ]);
        $user = Auth::user();
        $user->newpassword = bcrypt($request->get('newpassword'));
        $user->save();

        // return redirect()->route('user_info.index')->with('status', 'パスワードを変更しました。');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // 現在のパスワードが正しいかを調べる
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            return redirect()->back()->with('change_password_error', '現在のパスワードが間違っています。');
        }

        // 現在のパスワードと新しいパスワードが違っているかを調べる
        if (strcmp($request->get('current-password'), $request->get('newpassword')) == 0) {
            return redirect()->back()->with('change_password_error', '新しいパスワードが現在のパスワードと同じです。違うパスワードを設定してください。');
        }

        // パスワードのバリデーション。新しいパスワードは6文字以上、newpassword_confirmationフィールドの値と一致しているかどうか。
        $validated_data = $request->validate([
            'current-password' => 'required',
            'newpassword' => ['required','string','confirmed','min:8','regex:/^[a-zA-Z0-9]+$/'], //半角英数字のみ
        ]);

        //パスワード変更
        $user = Auth::user();
        $user->password = bcrypt($request->get('newpassword'));
        $user->save();

        return redirect()->route('user_info.index')->with('status', 'パスワードを変更しました。');
    }
}
