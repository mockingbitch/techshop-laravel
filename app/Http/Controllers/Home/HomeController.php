<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $productRepo;
    protected $categoryRepo;
    protected $brandRepo;
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        BrandRepositoryInterface $brandRepository
    )
    {
        $this->productRepo = $productRepository;
        $this->categoryRepo = $categoryRepository;
        $this->brandRepo = $brandRepository;
    }
    public function index(){
        $customer = Auth::guard('customer')->user();
        $products = $this->productRepo->getAll();
        $categories = $this->categoryRepo->getAll();
        $brands = $this->brandRepo->getAll();
        $carts = session()->get('cart');
        return view('home.pages.home',compact('products','categories','brands','customer','carts'));
    }
    public function productDetail($id){
        $product = $this->productRepo->find($id);
        $related_products = $this->productRepo->showRelatedProduct($id);
        return view('home.pages.view-product-detail',compact('product','related_products'));
    }
    public function showCategoryItems($id){
        $products = $this->productRepo->findByCategoryId($id);
        return view('home.pages.list-product',compact('products',));
    }
    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
    public function search(Request $request){
        $products = $this->productRepo->search($request);
        return view('home.pages.search',compact('products'));
    }
    public function getAll(){
        $products = $this->productRepo->getAllProduct();
        return view('home.pages.list-product',compact('products',));
    }
}
