<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return compact('tags');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $this->validate($request, ['name' => 'required']);
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();


        return Tag::orderBy('id', 'desc')->get()->first();
        // return compact('tag');
    }

    public function update(Request $request, $id)
    {
        // $tag = Tag::find($id);

        // $tag->name = $request->input('name');
        // $tag->save();
        $data=array();
        $data['name']=$request->name;
        DB::table('tags')->where('id',$id)->update($data);

        return Tag::find($id);
    }

}
