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
	public function profesores ()
	{
		$profesores = Profesores::all();
		return view('admin.profesores.index')->with(['profesores' => $profesores,]);
	}
	public function agregarProfesor(){
		return view('admin.agregar.profesor');
	}
	public function nuevoProfesor(Request $request){
		
		$datos = $request->validate([
			'rut' => 'required',
			'nombres' => 'required',
			'apellidos'=> 'required',
			'fnac' => 'required',
			'telefono' => 'required',
			'email' => 'email|required',
			'password' => 'required'
		]);

		$profesor = new Profesores;
		$profesor->rut = $datos['rut'];
		$profesor->nombres = $datos['nombres'];
		$profesor->apellidos = $datos['apellidos'];
		$profesor->fnac = $datos['fnac'];
		$profesor->telefono = $datos['telefono'];
		$profesor->email = $datos['email'];
		$profesor->password = bcrypt($datos['password']);
		$profesor->save();

		return back()->with('alert-success','El profesor se a guardado exitosamente');

	}
}
