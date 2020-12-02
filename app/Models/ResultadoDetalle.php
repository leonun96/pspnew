<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadoDetalle extends Model
{
    use HasFactory;
    protected $table = "resultado_detalles";
    protected $guarded = [];

    public function resultado(){
        // return $this->belongsTo('App\Models\ResultadoEvaluacion');
         return $this->hasMany('App\Models\ResultadoEvaluacion','resultado_evaluacions_id');
    }
    public function respuestas ()
	{
		return $this->belongsTo('App\Models\Respuestas','respuestas_selec');
    }
    public function preguntas ()
	{
		return $this->belongsTo('App\Models\Preguntas');
    }
    
}
