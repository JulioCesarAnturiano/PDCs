<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VotoGeografico extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'voto_geografico';
    protected $primaryKey = 'id_geografico';

    protected $fillable = [
        'nombre',
        'codigo',
        'ubicacion',
        'tipo',
        'fk_id_geografico',
    ];

    const TIPO_PAIS = 'PAIS';
    const TIPO_CIUDAD = 'CIUDAD';
    const TIPO_MUNICIPIO = 'MUNICIPIO';
    const TIPO_LOCALIDAD = 'LOCALIDAD';
    const TIPO_RECINTO = 'RECINTO';

    public function padre()
    {
        return $this->belongsTo(VotoGeografico::class, 'fk_id_geografico', 'id_geografico');
    }

    public function hijos()
    {
        return $this->hasMany(VotoGeografico::class, 'fk_id_geografico', 'id_geografico');
    }

    public function mesas()
    {
        return $this->hasMany(VotoMesa::class, 'id_recinto', 'id_geografico');
    }
    public function recinto()
{
    return $this->belongsTo(\App\Models\VotoGeografico::class, 'id_recinto', 'id_geografico');
}

}
