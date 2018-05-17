<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;
use App\Post;
use DB;

class PostController extends Controller
{
    public function create(Request $request)
    {
        if (DB::table('group_user')->whereGroupId($request->group_id)->whereUserId($request->user()->id)->count()) {
            return view('user/post/create')->with('group_id', $request->group_id);
        } else {
            return redirect()->back()->withInput()->withErrors('You are not in this group!');
        }        
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:32',
            'content' => 'required',
            'group_id' => 'required',
        ]);
    
        $post = new Post;
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->group_id = $request->get('group_id');
        $post->user_id = $request->user()->id;
    
        if ($post->save()) {
            return redirect('groups/'.$post->group_id)->with('status', 'Create Post Success!');
        } else {
            return redirect()->back()->withInput()->withErrors('Create Post Failed!');
        }
    }
    public function edit($id)
    {
        return view('user/post/edit')->withPost(Post::find($id));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:32',
            'content' => 'required',
        ]);
    
        $post = Post::find($id);
        $post->title = $request->get('title');
        $post->content = $request->get('content');
    
        if ($post->save()) {
            return redirect('groups/'.$post->group_id)->with('status', 'Edit Post Success!');
        } else {
            return redirect()->back()->withInput()->withErrors('Edit Post Failed!');
        }
    }
    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('Post Deleted!');
    }                
}
