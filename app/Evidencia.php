<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    protected $fillable = [
        'img',
        'descripcion',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
