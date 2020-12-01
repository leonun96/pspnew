<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesAsignadasTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// debo arreglar la tabla
		Schema::create('actividades_asignadas', function (Blueprint $table) {
			$table->id();
			$table->foreignId('actividades_id')->constrained('actividades')->nullable();
			$table->foreignId('profesores_id')->constrained('profesores')->nullable();
			$table->foreignId('alumnos_id')->constrained('alumnos')->nullable();
			$table->date('fecha_inicio')->nullable();
			$table->date('fecha_termino')->nullable();
			$table->double('tiempo')->nullable();
			$table->string('estado')->nullable();
			$table->softDeletes();
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
		Schema::dropIfExists('actividades_asignadas');
	}
}
