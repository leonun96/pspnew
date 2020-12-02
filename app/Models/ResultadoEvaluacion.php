<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadoEvaluacion extends Model
{
    use HasFactory;
    protected $table = "resultado_evaluacions";
    protected $guarded = [];

    public function detalle(){
        return $this->hasMany('App\Models\ResultadoDetalle','resultado_evaluacions_id');
        // return $this->hasMany('App\Models\ResultadoEvaluacion','resultado_evaluacions_id');
    }
    public function alumnos()
	{
		return $this->belongsTo('App\Models\Alumnos');
    }
    public function actividadesAsignadas()
	{
		return $this->belongsTo('App\Models\ActividadesAsignadas');
	}
}
