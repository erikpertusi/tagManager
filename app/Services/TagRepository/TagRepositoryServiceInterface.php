<?php

namespace App\Services\TagRepository;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

interface TagRepositoryServiceInterface
{
    public function store(int $tag_id, int $repository_id);
}
