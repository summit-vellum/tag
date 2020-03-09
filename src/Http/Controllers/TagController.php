<?php

namespace Quill\Tag\Http\Controllers;

use Quill\Tag\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vellum\Contracts\Resource;

class TagController extends Controller
{
    protected $tag;

    public function __construct(Resource $resource)
    {
        $this->tag = $resource;
    }

    public function api(Tag $tag, Request $request)
    {
    	$limit = $request->input('limit', 10);
		$keyword = $request->input('q', false);
		$invisible = $request->input('invisible', 0);

		$data = $tag->whereValid();
		if ($keyword) {
			$data = $data->where('name', 'like', '%'.$keyword.'%')->orderByCount();
		}

		if ($invisible) {
			$data = $data->whereInvisible();
		} else {
			$data = $data->whereVisible();
		}

		if ($limit) {
			$data = $data->take($limit)->get()->toArray();
		}


		return response()->json(['data'=>$data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['column_name'] = $this->tag->getProperties();
        $data['rows'] = $this->tag->getValues();

        return view('tag::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
