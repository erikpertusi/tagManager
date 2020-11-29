<?php

namespace App\Http\Controllers;

use App\Services\Repository\RepositoryServiceFacade;
use App\Services\TagRepository\TagRepositoryServiceFacade;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        return RepositoryServiceFacade::store(
            $request->name,
            $request->owner,
            $request->link,
            $request->language,
            $request->stars
        );
    }

    public function associateTagRepository(Request $request)
    {
        return TagRepositoryServiceFacade::store($request->idTag, $request->idRepository);
    }
}
