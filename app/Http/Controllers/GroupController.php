<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;

class GroupController extends Controller
{
    public function index()
    {
        return view('group/index')->withGroups(Group::all());
    }
    public function show($id)
    {
        return view('group/show')->withGroup(Group::with('posts')->find($id));
    }    
}
