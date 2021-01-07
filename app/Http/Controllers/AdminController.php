<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Niveles;
use App\Models\Profesores;
use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Models\Alumnos;
use App\Models\Actividades;
use App\Models\Preguntas;
use App\Models\Respuestas;

use Flash;

class AdminController extends Controller
{
	public function index ()
	{
		$alumnos = Alumnos::count();
		$profesores = Profesores::count();
		return view('admin.index')->with([
			'alumnos' => $alumnos,
			'profesores' => $profesores,
		]);
	}
}
