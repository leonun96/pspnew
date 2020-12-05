<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnosticos extends Model
{
    use HasFactory,SoftDeletes;

    public function profesores()
	{
		return $this->belongsTo('App\Models\Profesores');
    }
    public function alumnos()
	{
		return $this->belongsTo('App\Models\Alumnos');
	}
}
