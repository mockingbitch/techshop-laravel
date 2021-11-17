<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Models\Cart;

class OrderService
{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }
    public function add($request,$subTotal,$code,$carts){
        $order=[
            'customerName'=>$request->customerName,
            'email'=>$request->email,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'note'=>$request->note,
            'status'=>0,
            'subTotal'=> $subTotal,
            'code'=>$code
        ];
       $addOrder = Order::create($order);
       foreach ($carts as $cart){
           $orderDetail = [
               'orderId'=>$addOrder->id,
               'productName'=>$cart['productName'],
               'quantity'=>$cart['quantity'],
               'productPrice'=>$cart['productPrice'],
               'total'=> $cart['quantity']*$cart['productPrice'],
               'productImage'=>$cart['productImage'],
               'code'=>$code,
           ];
           $addOrderDetail = OrderDetail::create($orderDetail);
       }
    }
    public function subTotal($carts){
        $subTotal = 0;
//        $carts = $carts->toArray();
        foreach ($carts as $cart){
            $orderDetail = [
                'quantity'=>$cart['quantity'],
                'productPrice'=>$cart['productPrice'],
                'total'=> $cart['quantity']*$cart['productPrice'],
            ];
            $total = $orderDetail['total'];
            $subTotal += $total;
        }
        return $subTotal;
    }
}
