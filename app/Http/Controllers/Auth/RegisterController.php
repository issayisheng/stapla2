<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // return response()->json(compact('token'));
        return response()->json(['token' => auth()->tokenById($user->id)]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'password' => ['required', 'string', 'min:8','confirmed','regex:/^[a-zA-Z0-9]+$/'], //半角英数字のみ
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>  bcrypt($data['password']),
        ]);
    }

    /**
      * Register a new user
      */
    // public function register(Request $request)
    // {
    //     $v = Validator::make($request->all(), [
    //         'name' => 'required|min:3',
    //         'email' => 'required|email|unique:users',
    //         'password'  => 'required|min:3|confirmed',
    //     ]);
    //     if ($v->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'errors' => $v->errors()
    //         ], 422);
    //     }
    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = bcrypt($request->password);
    //     $user->save();
    //     return response()->json(['status' => 'success'], 200);
    // }
}
