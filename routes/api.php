<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* ########## RUTA LOGIN PARA OBTENER TOKEN ########## */
Route::post('login','ApiController@login');
Route::get('/alumno','ApiController@user')->middleware('auth:alumno_api');

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::get('subcategoria/{id}','ProfesorController@apiSubcategorias');
