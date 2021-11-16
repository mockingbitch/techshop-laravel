<?php

namespace App\Services;

use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;

class ProductService
{
    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepo;

    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    /**
     * @param $request array
     */
    public function add($request)
    {
        $request['productImage'] = $this->imageProcessing($request['productImage']);
        $this->productRepo->create($request);
    }

    /**
     * @param $id int
     * @param $request array
     */
    public function update($id, $request)
    {

        $product = [
            'productName' => $request->productName,
            'productDescription' => $request->productDescription,
            'productContent' => $request->productContent,
            'productPrice'=> $request->productPrice,
            'categoryId'=>$request->categoryId,
            'brandId'=>$request->brandId,
            'productQuantity'=>$request->productQuantity,
        ];
        if($request->hasFile('productImage')){
            $product['productImage'] = $this->imageProcessing($request->productImage);
        }
        $this->productRepo->update($id, $product);
    }
    /**
     * @param $request array
     * @return mixed
     */
    public function imageProcessing($file)
    {
        $productImage = uniqid('',true) . $file->getClientOriginalName();
        $file->move('uploads/product',$productImage);
        return $productImage;
    }
}
