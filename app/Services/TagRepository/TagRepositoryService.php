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

    public function destroy(int $id)
    {
        $tag = $this->tagModel->find($id);
        // DELETE REPOSITORIES
        $tag->delete();
    }

    public function getTags(int $page, int $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $query = $this->tagModel->tagsByUser();


        return [
            'items' => $query->skip($offset)->take(10)->get(),
            'total_count' => $query->count()
        ];
    }
}
