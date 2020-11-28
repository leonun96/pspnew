<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategorias extends Model
{
    use HasFactory;
    protected $table='subcategorias';
	protected  $guarded = [];

	public function categorias ()
	{
		return $this->belongsTo('App\Models\Categorias');
	}

	public function actividades ()
	{
		return $this->hasMany('App\Models\Actividades');
	}
}
