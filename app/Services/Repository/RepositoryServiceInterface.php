<?php

namespace App\Services\Repository;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

interface RepositoryServiceInterface
{
    public function store(string $name, string $owner, string $link, string $language, int $stars);
}
