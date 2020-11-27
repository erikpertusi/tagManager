<?php

namespace App\Services\Tag;

use Illuminate\Support\Facades\Facade;

class TagServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        // Retorna o caminho da Interface, que será resolvida pelo Service Provider.
        return 'App\Services\Tag\TagServiceInterface';
    }
}
