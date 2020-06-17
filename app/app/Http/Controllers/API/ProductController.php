<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCSVInsertRequest;
use App\Http\Requests\ProductListRequest;
use App\Repositories\ProductRepositoryInterface;
use App\Services\CSVService;

class ProductController extends Controller
{
    /**
     * ProductRepository reference
     *
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(ProductListRequest $request)
    {
        $category = $request->category ?? null;
        $products = $this->productRepository->getProductList($category);

        $response = [
            'ok' => true,
            'message' => 'Successfully retrieved products!',
            'data' => $products
        ];

        return response()->json($response, 200);
    }

    public function insertCSV(ProductCSVInsertRequest $request, CSVService $service)
    {
        $attachment = $request->file('file');
        $products = $service->parseCSV($attachment->path());
        $inserted = $this->productRepository->createMany($products);

        $response = [
            'ok' => true,
            'message' => 'Successfully inserted products from CSV file!',
            'data' => $products
        ];

        return response()->json($response, 201);
    }
}
