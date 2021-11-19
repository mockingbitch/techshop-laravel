<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    protected $customerService;
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(){
        return view('home.customer.login');
    }
    public function registerForm(){
        return view('home.customer.register');
    }
    public function register(Request $request){
        $this->customerService->create($request);
    }
    public function login(Request $request){
        $credentials =  $request->only('email', 'password');
        if (Auth::guard('customer')->attempt($credentials)) {
            if (Auth::guard('customer')->user()->emailVerify==''){
                Auth::guard('customer')->logout();
                return redirect()->route('customer-login')->with('msg','Please <a href="https://gmail.com">verify</a> your account');
                }
            elseif (Auth::guard('customer')->user()->emailVerify=='1'){
                return redirect('/home');
            }
            else{
                Auth::guard('customer')->logout();
                return redirect()->route('customer-login')->with('msg','Something went wrong');
            }
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
    public function verify(Customer $customer,$token){
        if ($customer->rememberToken === $token){
            $customer->update(['emailVerify'=>1,'rememberToken'=>null]);
            return redirect()->route('home.customer.login')->with('msg','Verify Success');
        }else{
            return redirect()->route('home.customer.login')->with('msg','Can not verify your email!');
        }
    }
}
