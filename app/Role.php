<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //TODO cambir tabla

    protected $table = 'roles';
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
