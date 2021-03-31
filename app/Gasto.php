<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $fillable = [
        'service_id',
        'nombre',
        'descripcion',
        'importeminus',
        'valor',
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
