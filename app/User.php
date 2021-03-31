<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'name',
        'identificacion',
        'estado',
        'email',
        'password',
        'tipo_contrato',
        'porcentual_home',
        'porcentual_taller',
        'eps',
        'arl',
        'ccf',
        'fecha_c',
        'fecha_ingreso',
        'fecha_retiro',
        'direccion',
        'telefono',
        'company',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    

    public function rols()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
        if ($this->rols()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
