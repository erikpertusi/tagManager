<?php

namespace App\Services\TagRepository;

use App\TagRepository;

class TagRepositoryService implements TagRepositoryServiceInterface
{
    private $tagRepositoryModel;

    public function __construct(TagRepository $tagRepositoryModel)
    {
        $this->tagRepositoryModel = $tagRepositoryModel;
    }

    public function store(int $tag_id, int $repository_id)
    {
        $tagRepository = $this->tagRepositoryModel->firstOrCreate([
            'tag_id' => $tag_id,
            'repository_id' => $repository_id
        ]);
        return $tagRepository;
    }
}
