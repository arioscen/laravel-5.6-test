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
        if (DB::table('group_user')->whereGroupId($request->get('group_id'))->whereUserId($request->user()->id)->count()) {
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
        } else {
            return redirect()->back()->withInput()->withErrors('You are not in this group!');
        }
    }
    public function edit(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post->user_id == $request->user()->id) {
            return view('user/post/edit')->withPost($post);
        } else {
            return redirect()->back()->withInput()->withErrors('You do not have permission to edit this post!');
        }        
    }
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post->user_id == $request->user()->id) {
            $this->validate($request, [
                'title' => 'required|max:32',
                'content' => 'required',
            ]);
        
            $post->title = $request->get('title');
            $post->content = $request->get('content');
        
            if ($post->save()) {
                return redirect('groups/'.$post->group_id)->with('status', 'Edit Post Success!');
            } else {
                return redirect()->back()->withInput()->withErrors('Edit Post Failed!');
            }
        } else {
            return redirect()->back()->withInput()->withErrors('You do not have permission to edit this post!');
        }         
    }
    public function destroy(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post->user_id == $request->user()->id) {
            $post->delete();
            return redirect()->back()->withInput()->withErrors('Post Deleted!');
        } else {
            return redirect()->back()->withInput()->withErrors('You do not have permission to edit this post!');
        }
    }                
}
