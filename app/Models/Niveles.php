<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Niveles extends Model
{
    use HasFactory,SoftDeletes;
    protected $table='niveles';
	protected  $guarded = [];
	public function actividades ()
	{
		return $this->hasMany('App\Models\Actividades');
	}
}
