<?php

namespace App\Repositories\Contracts\Repository;

use App\Models\Product;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }
    public function findByCategoryId($id){
        $result = $this->model->where('categoryId',$id)->get();
        return $result;
    }
    public function showRelatedProduct($id){
        $product = $this->model->find($id);
        $result = $this->model->where('brandId',$product->brandId)->get();
        return $result;
    }
    public function search($request){
        $textSearch = $request->textSearch;
        $result = $this->model->where('productName','like',$textSearch)->get();
        return $result;
    }
}
