<?php
namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Models\Cart;
class CartService
{
    protected $productRepo;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }
    public function add($id){
        $products = $this->productRepo->find($id);
        $cart = session()->get('cart');
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
//        $customerId = Auth::guard('customer')->user()->id;
//        if (isset($customerId)){
//            $sessionId = session()->getId();
//            $cartProduct=[
//                'customerId'=>$customerId,
//                'productId'=>$cart[$id]['id'],
//                'quantity'=>$cart[$id]['quantity'],
//                'sessionId'=>$sessionId,
//                'status'=>0,
//                'productPrice'=>$cart[$id]['productPrice'],
//                'productImage'=>$cart[$id]['productImage']
//            ];
//            Cart::create($cartProduct);
//        }
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
    public function checkOut(){
            $customer = Auth::guard('customer')->user();
            $mail = $customer['email'];
            $name = $customer['name'];
            $carts = session()->get('cart');
            Mail::send('home.mail.mail-cart',compact('customer','carts'),function($email) use($mail,$name){
                $email->subject('Techshop - Xác nhận đơn hàng');
                $email->to($mail,$name);
            });
    }
}
