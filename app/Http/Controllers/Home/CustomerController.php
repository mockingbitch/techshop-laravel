<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index(){
        return view('home.customer.login');
    }
    public function register(){
        return view('home.customer.register');
    }
    public function login(Request $request){
        $credentials =  $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect('/home');
        }
        else{
            return view('home.customer.login')->with('msg','Wrong username or password!!!');
        }
    }
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
}
