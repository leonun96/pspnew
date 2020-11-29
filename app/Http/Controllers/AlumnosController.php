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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AlumnosController extends Controller
{
	public function __construct ()
	{
		//
	}

	public function menuPrincipal()
	{
		$alumnos = Alumnos::all()->count();
		$act = Actividades::all()->count();
		// dd($alumnos);
		return view('alumnos.menu')
		->with('act',$act)
		->with('alumnos',$alumnos);
	}

	public function editar(){
		$perfil = Auth('alumno')->user();
		return view('alumnos.editar.perfil')
		->with('perfil',$perfil);
	}
	
	public function editarPerfil(Request $request ){

		$validacion = $request->validate([
			'rut' => 'required',
			'nombres' => 'required',
			'apellidos'=> 'required',
			'fnac' => 'required',
			'telefono' => 'numeric|required',
			'email' => 'email|required',
			'password' => 'required'
		]);
		
			// if para el cambio de contraseña sea opcional
		if($validacion['password'] != null){
			$validacion['password'] = bcrypt($validacion['password']);
		}else{
			// unset saca el campo password del array a editar
			unset($validacion['password']);
		}

		$perfil = Alumnos::where('id', Auth('alumno')->user()->id)
		->update([
			'rut' =>$validacion['rut'],
			'nombres' => $validacion['nombres'],
			'apellidos'=> $validacion['apellidos'],
			'fnac' =>$validacion['fnac'],
			'telefono' => $validacion['telefono'],
			'email' => $validacion['email'],
			'password' => $validacion['password']
		]);
		
		return back()
		->with('flash','El perfil a sido editado exitosamente');
	}
}