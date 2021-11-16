<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});
//
//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->name('dashboard');
//
//Route::get('/email/verify', function () {
//    return view('auth.verify-email');
//})->middleware('auth')->name('verification.notice');
//
//Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//    $request->fulfill();
//
//    return redirect('/home');
//})->middleware(['auth', 'signed'])->name('verification.verify');
//
//Route::post('/email/verification-notification', function (Request $request) {
//    $request->user()->sendEmailVerificationNotification();
//
//    return back()->with('message', 'Verification link sent!');
//})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//Admin
Route::prefix('admin')->group(function (){
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/login', [AuthController::class, 'loginView']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::middleware(['checklogin'])->group(function(){
    Route::prefix('admin')->group(function (){
        Route::get('index',[AdminController::class,'index'])->name('admin.index');
        Route::get('/',[AdminController::class,'index'])->name('admin.index');
        Route::get('/onlyfan',[AdminController::class,'onlyfan'])->name('onlyfan');
        Route::get('/profile',[AdminController::class,'viewProfile'])->name('profile');


        //categories
        Route::prefix('category')->group(function (){
            Route::get('add-category', [CategoryController::class, 'create'])->name('add-category.index');
            Route::post('add-category', [CategoryController::class, 'store'])->name('add-category.create');
            Route::get('list-category', [CategoryController::class, 'index'])->name('list-category.index');
            Route::get('delete-category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
            Route::get('edit-category/{id}', [CategoryController::class, 'show'])->name('category.edit');
            Route::post('edit-category/{id}', [CategoryController::class, 'update']);
        });


        //Brand
        Route::prefix('brand')->group(function (){
            Route::get('add-brand', [BrandController::class, 'create'])->name('add-brand.index');
            Route::post('add-brand', [BrandController::class, 'store'])->name('add-brand.create');
            Route::get('list-brand', [BrandController::class, 'index'])->name('list-brand.index');
            Route::get('delete-brand/{id}', [BrandController::class, 'destroy'])->name('brand.delete');
            Route::get('edit-brand/{id}', [BrandController::class, 'show'])->name('brand.edit');
            Route::post('edit-brand/{id}', [BrandController::class, 'update']);
        });


        //Product
        Route::prefix('product')->group(function (){
            Route::get('add-product', [ProductController::class, 'create'])->name('add-product.index');
            Route::post('add-product', [ProductController::class, 'store'])->name('add-product.create');
            Route::get('list-product', [ProductController::class, 'index'])->name('list-product.index');
            Route::get('delete-product/{id}', [ProductController::class, 'destroy'])->name('product.delete');
            Route::get('edit-product/{id}', [ProductController::class, 'show'])->name('product.edit');
            Route::post('edit-product/{id}', [ProductController::class, 'update']);
        });
    });
});

//User
Route::prefix('user')->group(function (){
    Route::get('/login',[UserController::class,'index'])->name('user-login-page');
    Route::get('/register',[UserController::class,'register'])->name('user-register-page');
});

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/category/{id}',[HomeController::class,'showCategoryItems'])->name('category');
Route::get('/product/{id}',[HomeController::class,'productDetail'])->name('view-product');
Route::get('/add-to-cart',[CartController::class,'add'])->name('add-to-cart');
Route::get('/view-cart',[CartController::class,'index'])->name('view-cart');
Route::prefix('cart')->group(function(){
    Route::get('/remove-cart' ,[CartController::class,'delete'])->name('remove-cart');
    Route::get('/update-cart',[CartController::class,'update'])->name('update-cart');
});
