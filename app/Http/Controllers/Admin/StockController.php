<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\StockRepositoryInterface;
use Illuminate\Http\Request;

class StockController extends Controller
{
    protected $stockRepo;
    public function __construct(StockRepositoryInterface $stockRepository ){
        $this->stockRepo = $stockRepository;
    }
    public function index(){
        $products = $this->stockRepo->getAll();
        return view('admin.stock.stock',compact('products'));
    }
}
