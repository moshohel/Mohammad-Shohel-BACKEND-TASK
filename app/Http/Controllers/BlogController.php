<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Session;
use Purifier;

class BlogController extends Controller
{
    /**
     *
     *
     * @return csrf_token
     */
    public function getToken()
    {
        return csrf_token();
    }

    /**
     *
     *
     * @return All Blog posts in desc order
     */
    public function index (Request $request){
        $posts = Post::orderBy('id', 'desc')->get();
        return compact('posts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, array(
                'title'         => 'required|max:255',
                'body'          => 'required'
            ));

        // store in the database
        $post = new Post;
        $post->title = $request->title;
        $post->user_id = Auth::id();
        $post->body = $request->body;

        $post->save();

        $post->tags()->sync($request->tags, false);

        // return redirect()->route('posts.show', $post->id);
        return Post::orderBy('id', 'desc')->get()->first();
    }
}
