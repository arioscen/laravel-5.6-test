<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function show($id)
    {
        return view('post/show')->withPost(Post::with('comments')->find($id));
    }
}
