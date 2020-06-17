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

    /**
     * Should inserts an array of objects into the database.
     *
     * @param $collection
     * @return mixed
     */
    public function createMany(array $collection);
}