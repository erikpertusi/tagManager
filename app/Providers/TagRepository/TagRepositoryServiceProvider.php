<?php

namespace App\Providers\TagRepository;

use Illuminate\Support\ServiceProvider;

class TagRepositoryServiceProvider extends ServiceProvider
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
            'App\Services\TagRepository\TagRepositoryServiceInterface',
            'App\Services\TagRepository\TagRepositoryService'
        );
    }
}
