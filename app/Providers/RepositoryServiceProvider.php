<?php

namespace App\Providers;

use App\Interfaces\PersistenceServiceInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Repositories\PostRepository;
use App\Services\PersistenceServiceApi;
use App\Services\PersistenceServiceInMemory;
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
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);

        // TODO Para los test, uso el de PersistenceServiceInMemory (esto no haría falta, si consigo usar los Mock en los test)
        if ($this->app->runningUnitTests()) {
            $this->app->bind(PersistenceServiceInterface::class, PersistenceServiceInMemory::class);
        } else {
            $this->app->bind(PersistenceServiceInterface::class, PersistenceServiceApi::class);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
