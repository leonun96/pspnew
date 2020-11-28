<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Niveles;
use App\Models\Profesores;
use App\Models\Categorias;
use App\Models\Subcategorias;

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
}
