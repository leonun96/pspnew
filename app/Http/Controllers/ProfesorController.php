<?php

namespace App\Http\Controllers;

use Flash;
use Storage;
use App\Models\User;
use App\Models\Alumnos;
use App\Models\Niveles;
use App\Models\Preguntas;
use App\Models\Categorias;
use App\Models\Documentos;
use App\Models\Profesores;
use App\Models\Respuestas;
use App\Models\Actividades;
use App\Models\Diagnosticos;
use Illuminate\Http\Request;
use App\Models\Subcategorias;
use App\Models\DocumentosAsignados;
use App\Models\ActividadesAsignadas;
use Illuminate\Support\Facades\Auth;
use Hash;

class ProfesorController extends Controller
{
	/* ########## PERFIL PROFESOR ########## */
	public function editar()
	{
		$profesor = Profesores::where('id',auth('')->user()->id)->get();
		return view('profesores.editar.perfil')->with('profesor',$profesor);
	}

	public function editarPerfil(Request $request)
	{
		$validacion = $request->validate([
			'rut' => 'required',
			'nombres' => 'required',
			'apellidos'=> 'required',
			'fnac' => 'required',
			'telefono' => 'numeric|required',
			'email' => 'email|required',
		]);

		$perfil = Profesores::where('id', Auth()->user()->id)->update([
			'rut' =>$validacion['rut'],
			'nombres' => $validacion['nombres'],
			'apellidos'=> $validacion['apellidos'],
			'fnac' =>$validacion['fnac'],
			'telefono' => $validacion['telefono'],
			'email' => $validacion['email'],
		]);
		
		return back()
		->with('flash','El perfil a sido editado exitosamente');
	}
	public function editarPass ()
	{
		return view('profesores.editar.pass');
	}
	public function cambiarPass (Request $request)
	{
		$val = $request->validate([
			'password_old' => 'required',
			'password' => 'required|confirmed|min:6',
		],[
			'password_old.required' => 'Ingrese su contraseña actual',
			'password.required' => 'Ingrese la contraseña nueva',
			'password.confirmed' => 'Confirme su contraseña nueva',
			'password.min' => 'Largo minimo de 6 caracteres',
		]);
		if (Hash::check($request->password_old, auth('profesores')->user()->password)) {
			Profesores::find(auth('profesores')->user()->id)->update([
				'password' => bcrypt($val['password']),
			]);
		}
		Flash::success('Contraseña cambiada exitosamente');
		return redirect()->back();
	}
	/* ########## PERFIL PROFESOR ########## */
	public function menuPrincipal()
	{
		$alumnos = Alumnos::all()->count();
		$act = Actividades::all()->count();
		// dd($alumnos);
		return view('profesores.menu')
		->with('act',$act)
		->with('alumnos',$alumnos);
	}

	public function agregarAlumno()
	{
		$profesores = Profesores::all();
		
		return view('profesores.agregar.alumno')
		->with('profesores',$profesores);
	}
	public function nuevoAlumno(Request $request)
	{
		$validacion = $request->validate([
			'rut' => 'required',
			'nombres' => 'required',
			'apellidos'=> 'required',
			'fnac' => 'required',
			'telefono' => 'numeric|required',
			'email' => 'email|required',
			'diagnostico' => 'required',
		]);

		/* ##### VALIDACION ##### */
		$alumn = Alumnos::withTrashed()->where('rut', $request->rut)
			->where('profesores_id', auth('profesores')->user()->id)
			->first();
		if (!is_null($alumn)) {
			Flash::error('Un alumno con ese rut ya está registrado en el sistema');
			return redirect()->back();
		}
		
		$pass = bcrypt($request->rut);

		$alumno = new Alumnos;

		$alumno->rut = $request->rut;
		$alumno->nombres = $request->nombres;
		$alumno->apellidos = $request->apellidos;
		$alumno->fnac = $request->fnac;
		$alumno->telefono = $request->telefono;
		$alumno->email = $request->email;
		$alumno->password = $pass;
		$alumno->NEE = $request->diagnostico;
		$alumno->profesores_id = auth('profesores')->user()->id;

		$alumno->save();

		return back()
		->with('flash','El alumno a sido agregado exitosamente');

	}

	public function verAlumnos(){
		$alumnos = Alumnos::all();
		return view('profesores.ver.alumnos')
		->with('alumnos',$alumnos);
	}

	public function eliminarAlumno($id){
		$alumno = Alumnos::find($id);
		$alumno->delete();
		return back()
		->with('flash-deleted','El alumno a sido eliminado');;
	}
	public function editarAlumno(Request $request,$id){

		$alumno = Alumnos::find($id);

		$alumno->rut = $request->rut;
		$alumno->nombres = $request->nombres;
		$alumno->apellidos = $request->apellidos;
		$alumno->fnac = $request->fnac;
		$alumno->telefono = $request->telefono;
		$alumno->email = $request->email;
		$alumno->NEE = $request->diagnostico;
		$alumno->profesores_id = $request->profesor_id;
		$alumno->save();

		return back()
		->with('flash-edit','El alumno a sido editado exitosamente');
	}


	public function agregarActividad()
	{
		$categorias = Categorias::all();
		$niveles = Niveles::all();
		return view('profesores.agregar.actividad')
		->with('categorias',$categorias)
		->with('niveles',$niveles);
	}

	public function apiSubcategorias($id)
	{
		return $subcategorias = Subcategorias::where('categorias_id',$id)->get();
	}

	public function nuevaActividad(Request $request)
	{
		$validacion = $request->validate([
			'nombre' => 'required',
			'categorias' => 'required',
			'subcategorias'=> 'required',
			'niveles' => 'required',
		]);
		
		$actividad = new Actividades;
		$actividad->nombre = $request->nombre;
		$actividad->subcategorias_id = $request->subcategorias;
		$actividad->niveles_id = $request->niveles;
		$actividad->profesores_id = Auth()->user()->id;
		$actividad->save();
		return redirect()->route('profesor.agregarPreguntas',$actividad->id);

	}
	public function eliminarAct ($id)
	{
		$actividad = Actividades::find($id);
		$pregs = Preguntas::where('actividades_id', $id)->get();
		foreach ($pregs as $key => $value) {
			$respuesta = Respuestas::where('preguntas_id', $value->id)->delete();
			$value->delete();
		}
		$actividad->delete();
		return redirect()->back()->with('flash-warning','La actividad a sido eliminada del sistema');
	}

	public function agregarPreguntas($actividad)
	{
		
		$actividad = Actividades::find($actividad)->load(['preguntas','preguntas.respuestas']);	
		return view('profesores.agregar.preguntas')
		->with('actividad',$actividad);
	}

	public function nuevaPregunta(Request $request, $actividad)
	{
		$val =  $request->validate([
			'pregunta' => ['required','string','max:255'],
			'correcta' => ['required','string','max:255'],
			'incorrecta1' => ['required','string','max:255'],
		],[
			'pregunta.required' => 'Debe ingresar la pregunta',
			'correcta.required' => 'Debe ingresar la respuesta correcta',
			'incorrecta1.required' => 'Debe ingresar al menos una respuesta incorrecta',
		]);
		if($request->hasfile('imagen')){
			$file = $request->file('imagen');
			$nombre = time().$file->getClientOriginalName();
			$file->move(public_path().'/imagenes',$nombre);
		}else{
			$nombre ='';
		}

		$pregunta = new Preguntas;
		$pregunta->pregunta = $request->pregunta;
		$pregunta->imagen= $nombre;
		$pregunta->actividades_id = $actividad;
		$pregunta->save();
		
		$respuestas= new Respuestas;
		$respuestas->preguntas_id = $pregunta->id;
		$respuestas->respuesta = $request->correcta;
		$respuestas->correcta = 'si';
		$respuestas->save();
		
		$respuestas= new Respuestas;
		$respuestas->preguntas_id = $pregunta->id;
		$respuestas->respuesta = $request->incorrecta1;
		$respuestas->correcta = 'no';
		$respuestas->save();

		$respuestas= new Respuestas;
		$respuestas->preguntas_id = $pregunta->id;
		$respuestas->respuesta = $request->incorrecta2;
		$respuestas->correcta = 'no';
		$respuestas->save();

		$respuestas= new Respuestas;
		$respuestas->preguntas_id = $pregunta->id;
		$respuestas->respuesta = $request->incorrecta3;
		$respuestas->correcta = 'no';
		$respuestas->save();

		return back();
	}
	
	public function verActividades()
	{
		$alumnos = Alumnos::where('profesores_id', Auth()->user()->id)->get();
		$actividades = Actividades::where('profesores_id', Auth()->user()->id)->get();
		$categorias = Categorias::all();
		$subcategorias = Subcategorias::all();
		$niveles= Niveles::all();

		return view('profesores.ver.actividad')
		->with('alumnos',$alumnos)
		->with('categorias',$categorias)
		->with('subcategorias',$subcategorias)
		->with('niveles',$niveles)
		->with('actividades',$actividades);

	}
	public function editarActividad(Request $request, Actividades $actividad){

		
		
		$validacion = request()->validate([
			'nombre' => 'required|string',
			'categorias' =>'required',
			'subcategorias' => 'required',
			'nivel' => 'required'
		]);

		$actividad = Actividades::find($actividad->id);
		$actividad->nombre = $validacion['nombre'];
		$actividad->subcategorias_id = $validacion['subcategorias'];
		$actividad->niveles_id = $validacion['nivel'];
		$actividad->profesores_id = auth('profesores')->user()->id;
		$actividad->save();

		return back()
		->with('flash','La actividad a sido editada exitosamente');
	}
	public function asignarActividad(Actividades $id)
	{	
		$actividad = $id;
		
		$datos = request()->validate([
			'desde' => 'required',
			'hasta' => 'required',
			'tiempo' => 'required',
			'alumnos_id'=> 'required'
		]);
		
		
		foreach($datos['alumnos_id'] as $dato){
		//   dump($dato);
			$asignada= new ActividadesAsignadas;
			$asignada->actividades_id = $actividad->id;
			$asignada->profesores_id = Auth()->user()->id;
			$asignada->alumnos_id = $dato;
			$asignada->fecha_inicio = $datos['desde'];
			$asignada->fecha_termino = $datos['hasta'];
			$asignada->tiempo = $datos['tiempo'];
			$asignada->estado = "ACTIVO";
			$asignada->save();
		}

		return back()
		->with('flash','La actividad se asigno correctamente');

	}

	public function subirDoc()
	{
		return view('profesores.agregar.documento');
	}

	public function uploadDoc(Request $request)
	{
		$request->validate([
			'archivo' => 'required|file|mimes:pdf,txt,docx',
		],[
			'archivo.required' => 'Debe proporcionar un archivo válido',
			'archivo.file' => 'Debe proporcionar un archivo válido',
		]);
		if($request->hasfile('archivo')){

			$file = $request->file('archivo');
			$nombre = $file->getClientOriginalName();
			$file->move(public_path().'/archivos',$nombre);

			$documento= new Documentos;
			$documento->ruta = $nombre;
			$documento->profesores_id = Auth()->user()->id;
			$documento->save();

			return back()
			->with('flash','El documento se subio correctamente');
		}
		else
		{
			$nombre ='';
			return back()
			->with('flash','Error: el documento no se subio correctamente');
		}
	}	
	public function verDoc()
	{
		$documentos=Documentos::all()->where('profesores_id',Auth()->user()->id);
		$alumnos = Alumnos::all()->where('profesores_id',Auth()->user()->id);
		return view('profesores.ver.documentos')
		->with('alumnos',$alumnos)
		->with('documentos',$documentos);
	}
	public function asignarDocumento(Documentos $id){

		$documento = $id;
		
		$datos = request()->validate([
			'alumnos_id'=> 'required'
		]);
		
		// dump($datos);
		foreach($datos['alumnos_id'] as $dato){
	
		  	$asignado= new DocumentosAsignados();
			$asignado->documentos_id = $documento->id;
			$asignado->alumnos_id = $dato;
			$asignado->profesores_id = Auth()->user()->id;
			$asignado->save();
		}
		return back()
		->with('flash','El documento se asigno correctamente');
	}
	public function downloadDoc ($nombre)
	{
		return Storage::download($nombre);
	}

	public function nuevoDiagnostico($id)
	{
		$alumno = Alumnos::find($id);
		return view('profesores.agregar.diagnostico')->with('alumno',$alumno);
	}

	public function diagnostico(Request $request)
	{
		// dump($request);

		$validacion = $request->validate([
			'rut' => 'required',
			'diagnostico' => 'required'
		]);

		$diagnostico = new Diagnosticos;
		$diagnostico->profesores_id = Auth('profesores')->user()->id;
		$diagnostico->alumnos_id = $request->id;
		$diagnostico->diagnostico = $validacion['diagnostico'];
		$diagnostico->save();
		
		return redirect()->route('profesor.verAlumnos')
		->with('flash','Se creo diagnostico correctamente');;
	}



}
