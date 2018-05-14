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
        return view('group')->withGroups(Group::where('user_id', Auth::id())->get());
    }
}
