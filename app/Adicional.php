<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    protected $fillable = [
        'service_id',
        'nombre',
        'descripcion',
        'importeplus',
        'valor',
    ];

    public function services()
    {
        return $this->belongsTo(Service::class);
        // return $this->belongsToMany(Service::class);
    }
}
