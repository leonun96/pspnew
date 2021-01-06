<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesoresTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profesores', function (Blueprint $table) {
			$table->id();
			$table->string('rut')->unique()->nullable();
			$table->string('nombres')->nullable();
			$table->string('apellidos')->nullable();
			$table->date('fnac')->nullable();
			$table->integer('telefono')->nullable();
			$table->string('email')->nullable();
			$table->string('password')->nullable();
			$table->string('api_token')->nullable();
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
		Schema::dropIfExists('profesores');
	}
}
