<?php

namespace App\Providers\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    /**
     * Registra o Service Provider e vincula o serviço no Service Container do Laravel.
     */
    public function register()
    {
        $this->app->singleton(
            'App\Services\Repository\RepositoryServiceInterface',
            'App\Services\Repository\RepositoryService'
        );
    }
}
