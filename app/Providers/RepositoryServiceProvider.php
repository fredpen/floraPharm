<?php

namespace App\Providers;

use App\Interfaces\BrandInterface;
use App\Interfaces\UserInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\CategoryInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\WishListInterface;
use App\Repositories\BrandRespository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\WishListRepository;

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

    public $bindings = [
        UserInterface::class => UserRepository::class,
        CategoryInterface::class => CategoryRepository::class,
        ProductInterface::class => ProductRepository::class,
        BrandInterface::class => BrandRespository::class,
        WishListInterface::class => WishListRepository::class,
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
