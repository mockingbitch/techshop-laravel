<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('home.user.login');
    }
    public function register(){
        return view('home.user.register');
    }
    public function login(Request $request){
        $credentials =  $request->only('email', 'password');
        if (Auth::guard('user')->attempt($credentials)) {
            return redirect('/home');
        }
        else{
            return view('home.user.login')->with('msg','Wrong username or password!!!');
        }
    }
    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect('/');
    }
}
