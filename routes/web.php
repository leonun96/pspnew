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
		Route::get('/agregar-alumno','ProfesorController@agregarAlumno')->name('agregarAlumno');
		Route::post('/nuevo-alumno','ProfesorController@nuevoAlumno')->name('nuevoAlumno');
		Route::get('/alumnos', 'ProfesorController@verAlumnos')->name('verAlumnos');
		Route::delete('/eliminar-alumno/{id}', 'ProfesorController@eliminarAlumno')->name('eliminarAlumno');
		Route::post('/editar-alumno/{id}','ProfesorController@editarAlumno')->name('editarAlumno');
		/* ########## GESTION DE ALUMNO ########## */

		/* ########## ACTIVIDAD ########## */
		Route::get('/agregar-actividad','ProfesorController@agregarActividad')->name('agregarActividad');
		Route::post('/nueva-actividad','ProfesorController@nuevaActividad')->name('nuevaActividad');
		Route::get('/agregar-preguntas/{actividad}','ProfesorController@agregarPreguntas')->name('agregarPreguntas');
		Route::post('/nueva-pregunta/{actividad}','ProfesorController@nuevaPregunta')->name('nuevaPregunta');
		Route::get('/ver-actividades', 'ProfesorController@verActividades')->name('verActividades');
		Route::get('/actividades/{id}/eliminar', 'ProfesorController@eliminarAct')->name('eliminar.actividad');
		Route::put('/actividades/asignar/{id}','ProfesorController@asignarActividad')->name('asignarActividad');
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
		/* ########## PERFIL ########## */

		/* ########## DIAGNOSTICO ########## */

		Route::get('/diagnostico/nuevo/{id}', 'ProfesorController@nuevoDiagnostico')->name('nuevoDiagnostico');
		Route::post('/diagnostico/nuevo','ProfesorController@diagnostico')->name('diagnostico');
		/* ########## DIAGNOSTICO ########## */
	});
});

Route::group(['prefix' => 'alumno', 'as' => 'alumno.'], function() {
	/* RUTAS PARA EL ALUMNO LOGIN */
	Route::get('/', 'LogInController@accesoAlumnos')->name('accesoAlumno');
	Route::post('/login', 'LogInController@loginAlumnos')->name('loginAlumno');
	Route::get('logout', 'LogInController@logoutA')->name('logout');

	Route::group(['middleware' => ['auth:alumno']], function() {
		/* ##### Rutas que requieren autenticación ##### */
		Route::get('/menu', 'AlumnosController@menuPrincipal')->name('menu');

		/* ########## ACTIVIDAD ########## */
		Route::get('/actividades', 'AlumnosController@verActividades')->name('verActividades');
		Route::get('/actividades/resultados', 'AlumnosController@verResultados')->name('actividades.resultados');
		Route::get('/actividades/{id}/detalles','AlumnosController@verDetalles')->name('detalles');
		Route::get('/actividades/{actividad}/realizar', 'AlumnosController@realizarAct')->name('realizarAct');
		Route::put('/actividades/{id}/finalizada','AlumnosController@finalizada')->name('finalizada');
		/* ########## ACTIVIDAD ########## */

		/* ########## PERFIL ########## */
		Route::get('/editar','AlumnosController@editar')->name('editar');
		Route::post('/editar/perfil/','AlumnosController@editarPerfil')->name('editarPerfil');
		/* ########## PERFIL ########## */

		/* ########## DOCUMENTOS ########## */
		Route::get('/documentos/ver','AlumnosController@verDocumentos')->name('verDocumentos');
		/* ########## DOCUMENTOS ########## */
	});
});
/* ########## RUTAS DEFINITIVAS ########## */
