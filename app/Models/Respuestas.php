<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Respuestas extends Model
{
	use HasFactory;
	use SoftDeletes;
    protected $table = "respuestas";
	protected $guarded = [];
	public function preguntas ()
	{
		$this->belongsTo('App\Models\Preguntas');
	}
}
