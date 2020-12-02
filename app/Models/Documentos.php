<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documentos extends Model
{
    use HasFactory,SoftDeletes;

    public function profesores()
	{
		return $this->belongsTo('App\Models\Documentos');
	}
	public function asignados(){

		return $this->hasMany('App\Models\DocumentosAsignados');
	}
}
