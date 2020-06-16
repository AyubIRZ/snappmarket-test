<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);

        $response = [
            'ok' => true,
            'message' => 'Successfully retrieved products!',
            'data' => $products
        ];

        return response()->json($response, 200);
    }
}
