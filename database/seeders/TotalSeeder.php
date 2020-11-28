<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Niveles;
use App\Models\Profesores;
use App\Models\Categorias;
use App\Models\Subcategorias;

class TotalSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Profesores::create([
			'rut' => '11111111-1',
			'nombres' => 'Profesor',
			'apellidos' => 'Zúñiga',
			'fnac' => '1970-02-02',
			'telefono' => '123123123',
			'email' => 'profesor@test.com',
			'password' => bcrypt('123123')
		]);
		Categorias::create([
			'COD' => 'MAT',
			'nombre' => 'Matematicas'
		]);
		Categorias::create([
			'COD' => 'LEN',
			'nombre' => 'Lenguaje'
		]);
		Categorias::create([
			'COD' => 'HIS',
			'nombre' => 'Historia'
		]); 

		Subcategorias::create([
			'nombre' => 'Sumas',
			'categorias_id' => '1'
		]); 
		Subcategorias::create([
			'nombre' => 'Restas',
			'categorias_id' => '1'
		]); 
		Subcategorias::create([
			'nombre' => 'Multiplicacion',
			'categorias_id' => '1'
		]); 
		Subcategorias::create([
			'nombre' => 'Comprension lectora',
			'categorias_id' => '2'
		]); 
		Subcategorias::create([
			'nombre' => 'Redaccion',
			'categorias_id' => '2'
		]);
		Niveles::create([
			'COD' => 'BAJ',
			'nivel' => 'Bajo'
		]);
		Niveles::create([
			'COD' => 'MED',
			'nivel' => 'Medio'
		]);
		Niveles::create([
			'COD' => 'ALT',
			'nivel' => 'Alto'
		]);
	}
}
