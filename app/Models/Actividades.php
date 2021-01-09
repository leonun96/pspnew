<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actividades extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='actividades';
	protected  $guarded = [];

	public function subcategorias ()
	{
		return $this->belongsTo('App\Models\Subcategorias');
	}
	public function niveles ()
	{
		return $this->belongsTo('App\Models\Niveles');
	}
	public function preguntas ()
	{
		return $this->hasMany('App\Models\Preguntas');
	}
	public function asignadas ()
	{
		return $this->hasMany('App\Models\ActividadesAsignadas', 'actividades_id');
	}
	
}
