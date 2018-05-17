<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'post_id' => 'required',
        ]);
    
        $comment = new Comment;
        $comment->name = $request->get('name');
        $comment->content = $request->get('content');
        $comment->post_id = $request->get('post_id');
    
        if ($comment->save()) {
            return redirect('posts/'.$request->get('post_id'))->with('status', 'Create Comment Success!');
        } else {
            return redirect()->back()->withInput()->withErrors('Create Comment Failed!');
        }
    }
}
