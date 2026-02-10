<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class VotoUsuario extends Authenticatable
{
    use HasFactory, SoftDeletes, HasRoles;

    protected $table = 'voto_usuario';
    protected $primaryKey = 'id_usuario';
    protected $guard_name = 'sanctum';

    protected $fillable = [
        'nombre_usuario',
        'contrasena',
        'fecha_fin',
        'token',
    ];

    protected $hidden = [
        'contrasena',
        'token',
        'remember_token',
    ];

    protected $casts = [
        'fecha_fin' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getAuthIdentifierName()
    {
        return 'id_usuario';
    }

    public function getAuthPassword()
    {
        return $this->contrasena;
    }

    public function setContrasenaAttribute($value)
    {
        $this->attributes['contrasena'] = bcrypt($value);
    }

    public function isActive()
    {
        if ($this->fecha_fin && $this->fecha_fin < now()->toDateString()) {
            return false;
        }
        return true;
    }
}
