<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $admin = Auth::guard('admin')->user();
            return view('admin.adminLayout',['user'=>$admin]);
    }
    public function onlyfan(){
        return view('admin.pages.maincontent');
    }
}
