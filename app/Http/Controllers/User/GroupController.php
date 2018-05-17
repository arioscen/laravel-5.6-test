<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Group;

class GroupController extends Controller
{
    public function index()
    {
        return view('group/index')->withGroups(Group::where('user_id', Auth::id())->get());
    }
    public function create()
    {
        return view('user/group/create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:groups|max:32',
            'description' => 'required',
        ]);
    
        $group = new Group;
        $group->title = $request->get('title');
        $group->description = $request->get('description');
        $group->user_id = $request->user()->id;
    
        if ($group->save()) {
            return redirect('user/groups')->with('status', 'Create Group Success!');
        } else {
            return redirect()->back()->withInput()->withErrors('Create Group Failed!');
        }
    }
    public function edit(Request $request, $id)
    {
        $group = Group::find($id);
        if ($group->user_id == $request->user()->id) {
            return view('user/group/edit')->withGroup($group);
        } else {
            return redirect()->back()->withInput()->withErrors('You do not have permission to edit this group!');
        }        
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|unique:groups,title,'.$id.'|max:32',
            'description' => 'required',
        ]);
        $group = Group::find($id);
        $group->title = $request->get('title');
        $group->description = $request->get('description'); 
        
        if ($group->save()) {
            return redirect('user/groups')->with('status', 'Edit Group Success!');
        } else {
            return redirect()->back()->withInput()->withErrors('Edit Group Failed!');
        }               
    }
    public function destroy($id)
    {
        Group::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('Delete Group Success!');
    }
    public function show($id)
    {
        return view('group/show')->withGroup(Group::with('posts')->find($id));
    }    
}
