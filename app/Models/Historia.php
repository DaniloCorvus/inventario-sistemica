<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $fillable = [
        'fecha_registro',
        'accion',
        'user_id',
        'order_id',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
