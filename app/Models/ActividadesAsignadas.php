<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActividadesAsignadas extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "actividades_asignadas";
	protected $guarded = [];
	
	public function actividades()
	{
		return $this->belongsTo('App\Models\Actividades');
	}
	public function profesores()
	{
		return $this->belongsTo('App\Models\Profesores');
	}
	public function alumnos()
	{
		return $this->belongsTo('App\Models\Alumnos');
	}
	public function resultados ()
	{
		return $this->hasOne('App\Models\ResultadoEvaluacion');
	}
	
}

