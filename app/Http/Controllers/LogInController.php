<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LogInController extends Controller
{
	public function Acceso()
	{
		/* VALIDACION ACCESO A LOGIN O MENU */
		// $var = Auth::guard('profesores')->check();
		$var = auth('profesores')->check();
		if ($var) {
			return redirect()->route('profesor.menu');
		} else {
			return view('profesores.login');
		}
	}

	public function LogIn (Request $request)
	{
		$datos = $this->validate(request(),[
			'email' => 'email|required|string',
			'password' => 'required|string',
		]);

		// return $datos;
		if(Auth::guard('profesores')->attempt($datos)){
			return redirect()->route('profesor.menu');
		}else{
			return back()
			->withErrors([
				'email'=>'Vuelve a ingresar tu email',
				'password'=>'Vuelve a ingresar tu contraseña',
			])
			->withInput(request(['email']));
		}

	}
	public function logoutP ()
	{
		Auth::guard('profesores')->logout();
		return redirect()->route('profesor.acceso');
	}

	/* ########## LOGIN ALUMNOS ########## */
	public function accesoAlumnos()
	{
		return view('alumnos.login');
	}
	
	public function loginAlumnos (Request $request)
	{
		
		
		$datos = $request->validate([
			'email' => 'email|required|string',
			'password' => 'required|string',
		]);

		if(Auth::guard('alumno')->attempt($datos)){
			return redirect()->route('alumno.menu');
		}else{
			return back()->withErrors([
				'email'=>'Vuelve a ingresar tu email',
				'password'=>'Vuelve a ingresar tu contraseña',
			])->withInput(request(['email']));
		}
	}

	public function logoutA ()
	{
		Auth::guard('alumno')->logout();
		return redirect()->route('alumno.accesoAlumno');
	}

}
