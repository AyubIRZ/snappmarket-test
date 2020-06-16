<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(ProductRepositoryInterface $productRepository)
    {
        $products = $productRepository->getProductList();

        $response = [
            'ok' => true,
            'message' => 'Successfully retrieved products!',
            'data' => $products
        ];

        return response()->json($response, 200);
    }
}
