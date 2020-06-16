<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductListRequest;
use App\Repositories\ProductRepositoryInterface;

class ProductController extends Controller
{
    public function index(ProductRepositoryInterface $productRepository, ProductListRequest $request)
    {
        $category = $request->category ?? null;
        $products = $productRepository->getProductList($category);

        $response = [
            'ok' => true,
            'message' => 'Successfully retrieved products!',
            'data' => $products
        ];

        return response()->json($response, 200);
    }
}
