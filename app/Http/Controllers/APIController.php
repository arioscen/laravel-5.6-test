<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config;

class APIController extends Controller
{
    public function get(Request $request)
    {
        $name = $request->get('name');
        if ($name) {
            $configs = Config::whereName($name)->count();
            if ($configs) {
                $config = Config::whereName($name)->get()[0];
                return response()->json([
                    'name' => $config->name,
                    'value' => $config->value,
                ]);
            }
        }
        return response()->json([
            'name' => null,
            'value' => null,
        ]);
    }
    public function set(Request $request)
    {
        $name = $request->get('name');
        $value = $request->get('value');
        if ($name) {
            $configs = Config::whereName($name)->count();
            if ($configs) {
                $config = Config::whereName($name)->get()[0];
                if ($value) {
                    $config->value = $value;
                    $config->save();
                }
                return response()->json([
                    'name' => $config->name,
                    'value' => $config->value,
                ]);                
            }
        }
        return response()->json([
            'name' => null,
            'value' => null,
        ]);
    }    
    public function add(Request $request)
    {
        $name = $request->get('name','default_name');
        $value = $request->get('value', 'default_value');
        $file = $request->file('file');
        if ($file)
        {
            $file->storeAs(
                'api/', $file->getClientOriginalName()
            );
        }
        return response()->json([
            'name' => $name,
            'value' => $value,
            'file' => $file ? true : false,
        ]);
    }    
}
