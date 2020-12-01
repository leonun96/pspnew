<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultadoDetallesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resultado_detalles', function (Blueprint $table) {
			$table->id();
			$table->foreignId('resultado_evaluacions_id')->constrained('actividades')->nullable();
			$table->foreignId('preguntas_id')->constrained('preguntas')->nullable();
			$table->foreignId('respuestas_selec')->constrained('respuestas')->nullable();
			$table->foreignId('correcta')->nullable();
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
		Schema::dropIfExists('resultado_detalles');
	}
}
