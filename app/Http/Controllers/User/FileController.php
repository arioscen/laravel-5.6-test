<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    
    public function index(Request $request)
    {
        $files = Storage::allFiles('file/'.$request->user()->email);
        $results = array();
        foreach ($files as $path)
        {
            $pathArray = explode('/', $path);
            array_push($results, array_slice($pathArray, -2));
        }
        return view('user/file/index')->withResults($results);
    }
    public function create()
    {
        return view('user/file/create');
    }
    public function store(Request $request)
    {
        // $path = $request->file('file')->store('file');

        $filename = $request->file('file')->getclientoriginalname();
        $path = $request->file('file')->storeAs(
            'file/'.$request->user()->email.'/'.md5($filename.time()), $filename
        );
        return redirect()->back();
    }
    public function download(Request $request, $id)
    {
        $file = Storage::Files('file/'.$request->user()->email.'/'.$id)[0];
        return Storage::download($file);
    }
}
