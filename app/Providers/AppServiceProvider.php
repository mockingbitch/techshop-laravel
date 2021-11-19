<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public $bindings = [
        \App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\CategoryRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\BrandRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\ProductRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\OrderRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\OrderDetailRepository::class,
        \App\Repositories\Contracts\RepositoryInterface\StockRepositoryInterface::class
        => \App\Repositories\Contracts\Repository\StockRepository::class,
    ];


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.adminLayout', function($view) {
            $admin = Auth::guard('admin')->user();
            view()->share('admin', $admin);
        });
        view()->composer('home.homepage', function($view) {
            $customer = Auth::guard('customer')->user();
            view()->share('customer', $customer);
        });
        view()->composer('home.homepage', function($view) {
            $categories = Category::all();
            view()->share('categories', $categories);
        });
        view()->composer('home.homepage',function($view){
            $carts = session()->get('cart');
            view()->share('carts',$carts);
        });
    }
}
