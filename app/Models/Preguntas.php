<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Preguntas extends Model
{
    use HasFactory;
	protected $table='preguntas';
	protected  $guarded = [];
	public function actividades ()
	{
		return $this->belongsTo('App\Models\Actividades');
	}
	public function respuestas ()
	{
		return $this->HasMany('App\Models\Respuestas');
	}
}

