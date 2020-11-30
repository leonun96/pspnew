<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Profesores extends Authenticatable
{
    use HasFactory, SoftDeletes;
    protected $table='profesores';
	protected  $guarded = [];

    public function alumnos ()
	{
		return $this->hasMany('App\Models\Alumnos');
	}
	public function documentos ()
	{
		return $this->hasMany('App\Models\Documentos');
	}
}
