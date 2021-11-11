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
        $product = [
            'productName' => $request->productName,
            'productDescription' => $request->productDescription,
            'productContent' => $request->productContent,
            'productPrice'=> $request->productPrice,
            'categoryId'=>$request->categoryId,
            'brandId'=>$request->brandId
        ];
        if($request->hasFile('image')){
            $product['productImage'] = $this->imageProcessing($request);
        }
        $this->productRepo->create($product);
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
            'brandId'=>$request->brandId
        ];
        if($request->hasFile('productImage')){
            $product['productImage'] = $this->imageProcessing($request);
        }

        $this->productRepo->update($id, $product);
    }

    /**
     * @param $request array
     * @return mixed
     */
    public function imageProcessing($request)
    {
        $image = $request->file('productImage')->storeAs('uploads/imgProduct', uniqid() . '-' . $request->image->getClientOriginalName());
        return $image;
    }
}
