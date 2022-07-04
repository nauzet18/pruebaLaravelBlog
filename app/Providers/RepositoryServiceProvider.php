<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\PostRepositoryInterface;
use App\Repositories\PostRepository;

use App\Interfaces\PersistenceServiceInterface;
use App\Services\PersistenceServiceInMemory;
use App\Services\PersistenceServiceApi;


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

        //Para los test, uso el de PersistenceServiceInMemory (esto no haría falta, si consigo usar los Mock en los test)
        if($this->app->runningUnitTests()) {
           $this->app->bind( PersistenceServiceInterface::class, PersistenceServiceInMemory::class);
        } else {
           $this->app->bind( PersistenceServiceInterface::class, PersistenceServiceApi::class);
        }
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
