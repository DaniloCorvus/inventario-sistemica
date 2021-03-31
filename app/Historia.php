<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{
    protected $fillable = ['descripcion', 'user_id', 'service_id'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getCreatedAtAttribute()
    {
        return $this->attributes['created_at'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
