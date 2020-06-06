<?php

namespace App\Providers;

use App\Interfaces\UserInterface;
use App\Repositories\UserRepository;
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

    public $bindings = [
        UserInterface::class => UserRepository::class
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
