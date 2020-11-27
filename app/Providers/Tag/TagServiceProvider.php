<?php

namespace App\Providers\Tag;

use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
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
            'App\Services\Tag\TagServiceInterface',
            'App\Services\Tag\TagService'
        );
    }
}
