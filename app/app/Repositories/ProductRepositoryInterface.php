<?php


namespace App\Repositories;


interface ProductRepositoryInterface
{
    /**
     * Should return a collection of all products.
     *
     * @return mixed
     */
    public function all();

    /**
     * Should return a collection of all products filtered by a specific category.
     *
     * @param $categoryId
     * @return mixed
     */
    public function getProductList($categoryId = null);
}