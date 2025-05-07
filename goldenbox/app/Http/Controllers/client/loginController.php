<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    //
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'Email không được để trống!',
            'email.string' => 'Email phải là dạng chuỗi!',
            'email.email' => 'Email không đúng định dạng!',
            'email.max' => 'Email không được vượt quá 255 ký tự!',

            'password.required' => 'Mật khẩu không được để trống!',
            'password.string' => 'Mật khẩu phải là dạng chuỗi!',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự!',
        ]);


        $user = User::where('email','=',$request->input('email'))->first();


        if($user && Hash::check($request->input('password'),$user->password)){
            Auth::login($user);
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công!');
        } else {
            return redirect()->back()->with('error', 'Sai email hoặc mật khẩu!');
        }

    }
}
