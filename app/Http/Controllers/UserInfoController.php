<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user(); // ログイン中のユーザー情報
        return view('userinfo.index', compact('auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_info = User::find($id);
        return view('userinfo.edit', compact('user_info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->action === 'back') {
            return redirect()->route('user_info.index');
        } else {
            $validator = $request->validate([
                'name'   => 'required',
                'email'  => 'required|email',
                'tel'    => ['nullable','regex:/^(0{1}\d{9,10})$/'], // ハイフンなし,10or11桁
                'password' => ['nullable','string','confirmed','min:8','regex:/^[a-zA-Z0-9]+$/'], //半角英数字のみ
            ]);
            $users = User::find($id);
            $users->name = $request->name;
            $users->email = $request->email;
            $users->tel = $request->tel;
            $users->password = Hash::make($request->password);
            $users->save();
            return redirect()->route('user_info.index')->with('status', '編集が完了しました');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
