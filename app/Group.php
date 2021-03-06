<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User', 'group_user', 'group_id', 'user_id');
    }
    public function posts()
    {
        return $this->hasMany('App\Post', 'group_id', 'id');
    }
}
