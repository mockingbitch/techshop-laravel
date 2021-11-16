<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;
    protected $categoryRepo;
    public function __construct(CartService $cartService, CategoryRepositoryInterface $categoryRepository)
    {
        $this->cartService = $cartService;
        $this->categoryRepo = $categoryRepository;
    }

    public function add(Request $request){
        $id = $request->query('id');
        //session()->flush('cart');
        $this->cartService->add($id);
    }
    public function index(){
        $carts = session()->get('cart');
        $categories = $this->categoryRepo->getAll();
        return view('home.pages.view-cart',compact('carts','categories'));
    }
    public function update(Request $request){
        $id = $request->query('id');
        $quantity = $request->query('quantity');
        $this->cartService->update($id,$quantity);
    }
    public function delete(Request $request){
        $id = $request->query('id');
        $this->cartService->delete($id);
    }

}
