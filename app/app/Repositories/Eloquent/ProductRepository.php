<?php


namespace App\Repositories\Eloquent;


use App\Product;
use App\Repositories\ProductRepositoryInterface;
use phpDocumentor\Reflection\Types\This;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
     * ProductRepository constructor.
     *
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * Returns a collection of all Products.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|mixed
     */
    public function all()
    {
        return Parent::all();
    }

    /**
     * Finds and returns a specific product with the default relation.
     *
     * @param $id
     * @return BaseRepository|BaseRepository[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function find($id)
    {
        return parent::findWithRelations($id, ['category']);
    }

    /**
     * Returns a collection of all products filtered by a specific category.
     *
     * @param $categoryId
     * @return mixed
     */
    public function getProductList($categoryId = null)
    {
        $products = $this->model->with('category')->paginate(env('PAGINATION_PER_PAGE'));

        return $products;
    }
}