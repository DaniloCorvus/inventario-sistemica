<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
