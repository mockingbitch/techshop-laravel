<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\OrderDetailRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepo;
    protected $orderDetailRepo;
    public function __construct(OrderRepositoryInterface $orderRepository,
                                OrderDetailRepositoryInterface $orderDetailRepository){
        $this->orderRepo = $orderRepository;
        $this->orderDetailRepo = $orderDetailRepository;
    }
    public function index(){
        $orders = $this->orderRepo->getAll();
        return view('admin.order.list-order',compact('orders'));
    }
}
