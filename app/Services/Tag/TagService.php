<?php

namespace App\Services\Tag;

use App\Tag;
use Illuminate\Support\Facades\Auth;

class TagService implements TagServiceInterface
{
    private $tagModel;

    public function __construct(Tag $tagModel)
    {
        $this->tagModel = $tagModel;
    }

    public function store(int $id, string  $name)
    {
        $tag = $this->tagModel->find($id);
        if(!$tag) {
            $tag = new Tag;
            $tag->user_id = Auth::user()->id;
        }
        $tag->name = $name;
        $tag->save();
    }

    public function destroy(int $id)
    {
        $tag = $this->tagModel->find($id);
        // DELETE REPOSITORIES
        $tag->delete();
    }

    public function getTags(int $page)
    {
        $perPage = 10;
        $offset = ($page - 1) * $perPage;
        $query = $this->tagModel->where('user_id', Auth::user()->id);


        return $query->skip($offset)->take(10)->get();
    }
}
