<?php
namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;

class CartService
{
    protected $productRepo;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }
    public function add($id){
        $products = $this->productRepo->find($id);
//        if($products->promotion_price != 0){
//            $prices = $products->promotion_price;
//        }else{
//            $prices = $products->unit_price;
//        }
        $cart = session()->get( 'cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        }else{
            $cart[$id]=[
                'id'=>$products->id,
                'productName'=>$products->productName,
                'productPrice'=> $products->productPrice,
                'quantity'=>1,
                'productImage'=>$products->productImage
            ];
        }
        session()->put('cart',$cart);
        return response()->json(['code'=>200],200);
    }
    public function update($id,$quantity){
        if($id && $quantity){
            $cart = session()->get('cart');
            $cart[$id]['quantity'] = (int)$quantity ;
        }
        session()->put('cart',$cart);
        return response()->json(['code'=>200],200);
    }
    public function delete($id){
        if($id){
            $cart = session()->get('cart');
            unset($cart[$id]);
            session()->put('cart',$cart);
            return response()->json(['code'=>200],200);
        }
    }
}
