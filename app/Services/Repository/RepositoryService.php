<?php

namespace App\Services\Repository;

use App\Repository;

class RepositoryService implements RepositoryServiceInterface
{
    private $repositoryModel;

    public function __construct(Repository $repositoryModel)
    {
        $this->repositoryModel = $repositoryModel;
    }

    public function store(string $name, string $owner, string $link, string $language, int $stars)
    {
        $repository = $this->repositoryModel->where([
            'name' => $name,
            'owner' => $owner
        ])->first();
        if (!$repository) {
            $repository = new $this->repositoryModel;
            $repository->name = $name;
            $repository->owner = $owner;
            $repository->link = $link;
            $repository->language = $language;
            $repository->stars = $stars;
            $repository->save();
        }
        return $repository;
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
