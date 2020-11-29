<?php

namespace App\Services\Repository;

use Illuminate\Support\Facades\Facade;

class RepositoryServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        // Retorna o caminho da Interface, que será resolvida pelo Service Provider.
        return 'App\Services\Repository\RepositoryServiceInterface';
    }
}
