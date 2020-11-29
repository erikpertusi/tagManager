<?php

namespace App\Services\TagRepository;

use Illuminate\Support\Facades\Facade;

class TagRepositoryServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        // Retorna o caminho da Interface, que será resolvida pelo Service Provider.
        return 'App\Services\TagRepository\TagRepositoryServiceInterface';
    }
}
