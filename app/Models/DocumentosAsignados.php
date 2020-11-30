<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentosAsignados extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "documentos_asignados";
    protected $guarded = [];

    public function profesores()
	{
		return $this->belongsTo('App\Models\Documentos');
    }
    public function documentosAsignados()
	{
		return $this->belongsTo('App\Models\DocumentosAsignados');
    }
    
}
