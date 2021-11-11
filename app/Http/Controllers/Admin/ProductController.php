<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepo;
    protected $productService;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductService $productService
    )
    {
        $this->productRepo = $productRepository;
        $this->productService = $productService;
    }

    public function index()
    {
        $product = $this->productRepo->getAll();
        return view('admin.product.list-product', compact('product'));
    }

    public function destroy($id)
    {
        $this->productRepo->delete($id);

        return redirect()->back();
    }

    public function edit($id)
    {
        $product = $this->productRepo->find($id);

        return view('admin.product.edit-product',compact('product'));
    }

    public function update($id, Request $request)
    {
        $this->productService->update($id, $request);

        return redirect(route('product.index'));
    }
    public function create()
    {
        return view('admin.product.add-product');
    }
    public function store(Request $request){
        $this->productService->add($request);
        return redirect(route('product.index'));
    }
    public function viewDetail(Request $request)
    {
        $id = $request->query('id');
        $product = $this->productRepo->find($id);
        return response()->json($product);
    }
}
