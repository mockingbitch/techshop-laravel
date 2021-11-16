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
        $user = Auth::guard('user')->user();
        $products = $this->productRepo->getAll();
        $categories = $this->categoryRepo->getAll();
        $brands = $this->brandRepo->getAll();
        return view('home.pages.home',compact('products','categories','brands','user'));
    }
    public function productDetail($id){
        $product = $this->productRepo->find($id);
        $categories = $this->categoryRepo->getAll();
        $related_products = $this->productRepo->showRelatedProduct($id);
        return view('home.pages.view-product-detail',compact('product','related_products','categories'));
    }
    public function showCategoryItems($id){
        $categories = $this->categoryRepo->getAll();
        $products = $this->productRepo->findByCategoryId($id);
        return view('home.pages.view-category-items',compact('products','categories'));
    }
}
