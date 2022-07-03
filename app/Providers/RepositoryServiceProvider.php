<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\PostRepositoryInterface;
use App\Repositories\PostRepository;

use App\Interfaces\PersistenceServiceInterface;
use App\Services\PersistenceServiceInMemory;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( PostRepositoryInterface::class, PostRepository::class);

        $this->app->bind( PersistenceServiceInterface::class, PersistenceServiceInMemory::class);
    }

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
