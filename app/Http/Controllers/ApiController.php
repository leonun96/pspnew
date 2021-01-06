<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
	public function __construct ()
	{
		// 
	}
	public function user (Request $request)
	{
		// Para obtener usuario
		return $request->user();
	}
	public function login ()
	{
		// LOGIN CON LA API
	}
}
