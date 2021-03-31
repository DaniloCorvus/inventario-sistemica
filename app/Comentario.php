<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [
        'user',
        'comentario',
        'service_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];


    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
