<?php

namespace App\Services;

use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Mail;
use Str;

class CustomerService
{
    public function create($request)
    {
        $request->validate([
            'customerName'=>'required',
            'password'=>'required',
            'email'=>'required',
            'confirmPassword'=>'required|same:password'
        ]);
        $data = $request->only('customerName','email','password');
        $password_hashed = Hash::make($request->password);
        $data['password']=$password_hashed;
        $token = strtoupper(Str::random(10));
        $data['rememberToken']=$token;
        if ($customer=Customer::create($data)){
            Mail::send('home.mail.mail-register',compact('customer'),function ($email) use($customer){
                $email->subject('Techshop - Xác nhận tài khoản của bạn!!!');
                $email->to($customer->email,$customer->customerName);
            });
            return redirect()->route('customer-login');
        }
        return redirect()->back();
    }
}
