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
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
	public function __construct ()
	{
		// 
	}
	public function index ()
	{
		return view('home');
	}
	public function artisan ()
	{
		Artisan::call('migrate:fresh --seed');
	}
}
