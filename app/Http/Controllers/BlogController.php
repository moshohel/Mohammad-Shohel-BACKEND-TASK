<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    // All Blog posts in desc order
    public function index (Request $request){
        $posts = Post::orderBy('id', 'desc')->get();
        return compact('posts');
    }
}
