<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        // return compact('posts');
        return json_encode(compact('posts'));
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
        // validate the data
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'body'          => 'required'
        ));

    // store in the database
    $post = new Post;
    $post->title = $request->title;
    // $post->user_id = Auth::id();
    $post->user_id = "1";
    $post->body = $request->body;

    $post->save();

    $post->tags()->sync($request->tags, false);

    // return redirect()->route('posts.show', $post->id);
    return json_encode(Post::orderBy('id', 'desc')->get()->first());
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
        // Validate the data
        $post = Post::find($id);
        $user_id = Auth::id();

        if ($user_id != $post->user_id)
        {
            $error = "User Don't match";
            return compact('error');
        }
        // Save the data to the database
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->body = Purifier::clean($request->input('body'));

        $post->save();

        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }


        // set flash data with success message
        $success = 'This post was successfully saved.';
        $upDatedPost = Post::find($id);

        // redirect with flash data to posts.show
        return compact('success', 'upDatedPost');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();

        $post->tags()->detach();

        $post->delete();

        Session::flash('success', 'The post was successfully deleted.');
        return redirect()->route('posts.index');
    }
}
