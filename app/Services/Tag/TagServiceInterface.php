<?php

namespace App\Services\Tag;

interface TagServiceInterface
{
    public function store(int $id, string $name);

    public function destroy(int $id);

    public function getTags(int $page, int $perPage);
}
