<?php

namespace App\Providers;

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
//            $admin = Model_product_type::all();
            view()->share('admin', $admin);
        });
    }
}
