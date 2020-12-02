<?php

namespace App\Http\Controllers;

use Flash;
use App\Models\User;
use App\Models\Alumnos;
use App\Models\Niveles;
use App\Models\Preguntas;
use App\Models\Categorias;
use App\Models\Documentos;
use App\Models\Profesores;
use App\Models\Respuestas;
use App\Models\Actividades;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Subcategorias;
use App\Models\ResultadoDetalle;
use App\Models\ResultadoEvaluacion;
use App\Models\ActividadesAsignadas;
use App\Models\DocumentosAsignados;
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
	public function realizarAct(Actividades $actividad)
	{
		// $actividad= $actividad->load(['preguntas','preguntas.respuestas']);
		$actividad= $actividad->load(['preguntas','preguntas.respuestas' => function ($query){
            $query->inRandomOrder();
        }]);
		// foreach ($actividad->preguntas as $pregunta) {
		// 	dump($pregunta);
		// 	foreach($pregunta->respuestas as $respuestas){
		// 		dump($respuestas);
		// 	}
		// }
		return view('alumnos.ver.actividad')
		->with('actividad',$actividad);
		
	}
	public function finalizada(Request $request, $id)
	{
		//  dd('En desarrollo',$request);
		if (!isset($request->pregunta) or count($request->pregunta) == 0) {
			$asig = ActividadesAsignadas::where('actividades_id',$id)
				->where('alumnos_id', auth('alumno')->user()->id)
				->first();
			ResultadoEvaluacion::create([
				'actividades_asignadas_id' => $asig->id,
				'alumnos_id' => auth('alumno')->user()->id,
				'puntaje' => 0,
				'nota' => 1.0,
			]);
			$asig->estado = "FINALIZADO";
			$asig->update();
			Flash::warning('Evaluacion finalizada, su nota es: 1.0');
			return redirect()->route('alumno.menu');
		} else {
			$asig = ActividadesAsignadas::where('actividades_id',$id)
				->where('alumnos_id', auth('alumno')->user()->id)
				->first();
			$total = ResultadoEvaluacion::updateOrCreate([
				'actividades_asignadas_id' => $asig->id,
				'alumnos_id' => auth('alumno')->user()->id,
				'puntaje' => null,
				'nota' => null,
			]);
			foreach ($request->pregunta as $key => $value) {
				// dump($key, $value);
				$res = Respuestas::find($value);
				ResultadoDetalle::create([
					'resultado_evaluacions_id' => $total->id,
					'preguntas_id' => $key,
					'respuestas_selec' => $value,
					'correcta' => $res->correcta,
				]);
			}
			$asig->estado = "FINALIZADO";
			$asig->update();
			Flash::warning('Evaluacion finalizada');
			return redirect()->route('alumno.menu');
		}
	}

	public function verActividades()
	{
		//traer actividades asignadas al alumno logeado
		$actividades = ActividadesAsignadas::where('estado', 'ACTIVO')
			->where('alumnos_id',auth('alumno')->user()->id)
			->get();

		// foreach($actividades as $dato){
		// 	dd($dato->actividades->nombre);
		// }

		return view('alumnos.ver.actividades')->with('actividades',$actividades);
	}
	public function verResultados()
	{
		$resultados = ResultadoEvaluacion::where('alumnos_id', auth('alumno')->user()->id )->get();
		return view('alumnos.ver.resultados')->with('resultados',$resultados);
	}
	public function verDetalles($id)
	{
		$detalle = ResultadoEvaluacion::find($id)->load(['detalle','detalle.preguntas','detalle.respuestas']);
		return view('alumnos.ver.detalles')->with('detalle',$detalle);
	}
	public function verDocumentos()
	{
		$documentos = DocumentosAsignados::where('alumnos_id', Auth('alumno')->user()->id)->get();
		return view('alumnos.ver.documentos')
		->with('documentos',$documentos);
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
