<?php

namespace App\Providers;

use App\Http\Controllers\API\V1\PostController as PostControllerV1;
use App\Http\Controllers\API\V2\PostController as PostControllerV2;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\PostV1Repository;
use App\Repositories\Eloquent\PostV2Repository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }
}
