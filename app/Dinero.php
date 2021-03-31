<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dinero extends Model
{
    protected $fillable = ['service_id', 'monto', 'fecha', 'observacion', 'method_pay', 'user_id'];

    protected $appends = ['hora'];

    public function getHoraAttribute()
    {
        return date('H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getFechaAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // TODO  Mejorar esto con repository

    public static function searhService($key)
    {
        return Service::findOrFail($key);
    }
    public static function totalRecibido($key)
    {
        return Dinero::where('service_id',$key)->sum('monto');
    }
}
