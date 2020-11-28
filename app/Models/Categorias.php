<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorias extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='categorias';
	protected  $guarded = [];
	public function subcategorias ()
	{
		return $this->hasMany('App\Models\Subcategorias');
	}
}
