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

class ActividadesController extends Controller
{
	/* ##### OBJETIVOS ##### */
	// PROFE
	// ASIGNAR ACTIVIDADS A ALUMNOS.
	// Recomendar actividades segun categorias/edades.
	// Enviar correos de actividades asignadas.
	// Alumno
	// Realizar actividades.
	// Guardar respuestas, resultados, etc.
	// Generar y enviar reportes al alumno.
	/* ##### OBJETIVOS ##### */
	public function __construct ()
	{
		//
	}
	public static function notificarAlumn (ActividadesAsignadas $act)
	{
		// MAIL notificando al alumno de que se le ha asignado una actividad
	}
	public function asignar (Request $request, $id)
	{
		/* ASIGNAR ACTIVIDAD A ALUMNO POR PARTE DE PROFESOR */
		// id de alumno, request con datos de inicio, fecha termino de actividad (plazos), mas alumno.
		$val = $request->validate([
			'alumnos_id' => 'required',
			'fecha_inicio' => 'required',
			'fecha_termino' => 'required',
			'tiempo' => 'required',
		],[
			'alumnos_id.required' => 'Debe seleccionar alumno',
			'fecha_inicio.required' => 'Seleccione fecha de inicio de la actividad',
			'fecha_termino.required' => 'Seleccione fecha de termino de la actividad',
			'tiempo.required' => 'Ingrese tiempo de desarrollo',
		]);
	}
}
