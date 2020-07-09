<?php

namespace App\Providers;

use App\Interfaces\BrandInterface;
use App\Interfaces\DeliveryLocationInterface;
use App\Interfaces\OrderInterface;
use App\Interfaces\PaymentInterface;
use App\Interfaces\UserInterface;
use App\Repositories\DeliveryLocationRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRepository;
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
        DeliveryLocationInterface::class => DeliveryLocationRepository::class,
        BrandInterface::class => BrandRespository::class,
        OrderInterface::class => OrderRepository::class,
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
