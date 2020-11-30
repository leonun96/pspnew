<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Alumnos extends Authenticatable
{
    use HasFactory,SoftDeletes;
    protected $table='alumnos';
	protected  $guarded = [];

	public function profesores()
	{
		return $this->belongsTo('App\Models\Profesores');
	}
	public function actividadesAsignadas(){

		return $this->hasMany('App\Models\ActividadesAsignadas');
	}
	public function documentosAsignados(){

		return $this->hasMany('App\Models\DocumentosAsignados');
	}
}
