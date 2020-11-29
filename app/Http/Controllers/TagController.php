<?php

namespace App\Http\Controllers;

use App\Services\Tag\TagServiceFacade;
use Illuminate\Http\Request;

class TagController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('vue.template.app-vue')->with([
            'title' => 'Tags',
            'vueComponent' => 'tags'
        ]);
    }

    public function store(Request $request)
    {
        return TagServiceFacade::store($request->id, $request->name);
    }


    public function destroy($id)
    {
        return TagServiceFacade::destroy($id);

    }

    public function get(Request $request)
    {
        return TagServiceFacade::getTags($request->p, $request->perPage);
    }
}
