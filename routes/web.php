<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
// 	return view('welcome');
// });

/* #################### TEST #################### */
// Route::get('artisan/test', 'HomeController@artisan');
Route::get('rutas/test', 'HomeController@rutas');
/* #################### TEST #################### */

/* #################### ADMIN #################### */
Route::group(['prefix' => 'admin', 'middleware' => 'auth:sanctum', 'as' => 'admin.'], function() {
	Route::get('/', 'AdminController@index')->name('index');

	Route::get('profesores/agregar-profesor','AdminController@agregarProfesor')->name('agregarProfesor');
	Route::get('/editar-profesor/{profe}','AdminController@editarProfesor')->name('editarProfesor');
	Route::get('/profesores', 'AdminController@profesores')->name('profesores');
	Route::post('/nuevo-profesor','AdminController@nuevoProfesor')->name('nuevoProfesor');
	Route::put('/update-profeso/{id}','AdminController@updateProfesor')->name('updateProfesor');

	Route::get('/alumnos', 'AdminController@alumnos')->name('alumnos');
	Route::get('alumnos/agregar-alumno','AdminController@agregarAlumno')->name('agregarAlumno');
	Route::post('/nuevo-alumno','AdminController@nuevoAlumno')->name('nuevoAlumno');
	
});
/* #################### ADMIN #################### */

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	return view('dashboard');
})->name('dashboard');

/* ########## RUTAS DEFINITIVAS ########## */

Route::get('/', 'HomeController@index')->name('/');

Route::group(['prefix' => 'profesor', 'as' => 'profesor.'], function() {

	Route::get('/', 'LogInController@Acceso')->name('acceso');
	Route::post('/login', 'LogInController@LogIn')->name('login');

	Route::group(['middleware' => ['auth:profesores']], function() {
		/* ##### Rutas que requieren autenticación ##### */
		Route::get('logout', 'LogInController@logoutP')->name('logout');
		Route::get('/menu','ProfesorController@menuPrincipal')->name('menu');
		/* ########## GESTION DE ALUMNO ########## */
		Route::get('/alumnos/agregar','ProfesorController@agregarAlumno')->name('agregarAlumno');
		Route::post('/nuevo-alumno','ProfesorController@nuevoAlumno')->name('nuevoAlumno');
		Route::get('/alumnos', 'ProfesorController@verAlumnos')->name('verAlumnos');
		Route::delete('/eliminar-alumno/{id}', 'ProfesorController@eliminarAlumno')->name('eliminarAlumno');
		Route::post('/editar-alumno/{id}','ProfesorController@editarAlumno')->name('editarAlumno');
		/* ########## GESTION DE ALUMNO ########## */

		/* ########## ACTIVIDAD ########## */
		Route::group(['prefix' => 'actividad'], function() {
			Route::get('create','ProfesorController@agregarActividad')->name('agregarActividad');
			Route::post('store','ProfesorController@nuevaActividad')->name('nuevaActividad');
			Route::get('preguntas/{actividad}','ProfesorController@agregarPreguntas')->name('agregarPreguntas');
			Route::put('pregunta/{actividad}/store','ProfesorController@nuevaPregunta')->name('nuevaPregunta');
			Route::get('pregunta/{id}/eliminar', 'ProfesorController@eliminarPregunta')->name('eliminarPregunta');
			Route::get('/', 'ProfesorController@verActividades')->name('verActividades');
			Route::get('actividades/{id}/eliminar', 'ProfesorController@eliminarAct')->name('eliminar.actividad');
			Route::put('actividades/asignar/{id}','ProfesorController@asignarActividad')->name('asignarActividad');
			Route::put('/editar/{actividad}','ProfesorController@editarActividad')->name('editarActividad');
			Route::put('/editar/respuesta/{id}','ProfesorController@editarRespuesta')->name('editarRespuesta');
			Route::put('/editar/pregunta/{actividad}','ProfesorController@editarPreguntas')->name('editarPreguntas');
			Route::get('/realizadas','ProfesorController@verActRealizadas')->name('verActRealizadas');
			Route::put('/resultados/{actividad}','ProfesorController@crearNota')->name('agregarResultado');
		});
		/* ########## ACTIVIDAD ########## */
		
		/* ########## DOCUMENTOS ########## */
		Route::get('/documento','ProfesorController@subirDoc')->name('subirDoc');
		Route::post('/documento/subir','ProfesorController@uploadDoc')->name('uploadDoc');
		Route::get('/documento/ver','ProfesorController@verDoc')->name('verDoc');
		Route::put('/documento/asignar/{id}','ProfesorController@asignarDocumento')->name('asignarDoc');
		/* ########## DOCUMENTOS ########## */

		/* ########## PERFIL ########## */
		Route::get('/editar','ProfesorController@editar')->name('editar');
		Route::post('/editar/perfil/','ProfesorController@editarPerfil')->name('editarPerfil');
		Route::get('editar/pass', 'ProfesorController@editarPass')->name('editar.pass');
		Route::post('cambiar/pass', 'ProfesorController@cambiarPass')->name('cambiar.pass');
		/* ########## PERFIL ########## */

		/* ########## DIAGNOSTICO ########## */

		Route::get('/diagnostico/nuevo/{id}', 'ProfesorController@nuevoDiagnostico')->name('nuevoDiagnostico');
		Route::post('/diagnostico/nuevo','ProfesorController@diagnostico')->name('diagnostico');
		Route::get('/diagnostico/eliminar/{id}', 'ProfesorController@borrarDiagnostico')->name('borrarDiagnostico');
		/* ########## DIAGNOSTICO ########## */
	});
});

Route::group(['prefix' => 'alumno', 'as' => 'alumno.'], function() {
	/* RUTAS PARA EL ALUMNO LOGIN */
	Route::get('/', 'LogInController@accesoAlumnos')->name('accesoAlumno');
	Route::post('/login', 'LogInController@loginAlumnos')->name('loginAlumno');

	Route::group(['middleware' => ['auth:alumno']], function() {
		/* ##### Rutas que requieren autenticación ##### */
		Route::get('logout', 'LogInController@logoutA')->name('logout');
		Route::get('/menu', 'AlumnosController@menuPrincipal')->name('menu');

		/* ########## ACTIVIDAD ########## */
		Route::get('/actividades', 'AlumnosController@verActividades')->name('verActividades');
		Route::get('/actividades/resultados', 'AlumnosController@verResultados')->name('actividades.resultados');
		Route::get('/actividades/{id}/detalles','AlumnosController@verDetalles')->name('detalles');
		Route::get('/actividades/{id}/realizar', 'AlumnosController@realizarAct')->name('realizarAct');
		Route::put('/actividades/{id}/finalizada','AlumnosController@finalizada')->name('finalizada');
		/* ########## ACTIVIDAD ########## */

		/* ########## PERFIL ########## */
		Route::get('/editar','AlumnosController@editar')->name('editar');
		Route::post('/editar/perfil/','AlumnosController@editarPerfil')->name('editarPerfil');
		Route::get('editar/pass', 'AlumnosController@editarPass')->name('editar.pass');
		Route::post('cambiar/pass', 'AlumnosController@cambiarPass')->name('cambiar.pass');
		/* ########## PERFIL ########## */

		/* ########## DOCUMENTOS ########## */
		Route::get('/documentos/ver','AlumnosController@verDocumentos')->name('verDocumentos');
		Route::get('documentos/{id}/descargar', 'AlumnosController@descargarDoc')->name('descargar_doc');
		/* ########## DOCUMENTOS ########## */
	});
});
/* ########## RUTAS DEFINITIVAS ########## */
