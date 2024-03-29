<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadoEvaluacionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resultado_evaluacions', function (Blueprint $table) {
			$table->id();
			$table->foreignId('actividades_asignadas_id')->constrained('actividades_asignadas')->nullable();
			// $table->foreignId('alumnos_id')->constrained('alumnos')->nullable();
			$table->double('puntaje')->nullable();
			$table->double('nota')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('resultado_evaluacions');
	}
}
