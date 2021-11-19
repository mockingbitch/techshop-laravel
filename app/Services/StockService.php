<?php

namespace App\Services;

use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use Illuminate\Support\Facades\Hash;


class StockService
{
    public function subtractOrder($id,$quantity)
    {
        $product = Stock::where('productId',$id)->get();
        $result = $product[0]['quantity'] - $quantity;
        if ($result >=0){
            $product[0]->update(['quantity'=>$result]);
            return true;
        }
        else{
            return false;
        }
    }
}
