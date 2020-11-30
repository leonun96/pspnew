<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosAsignadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_asignados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('documentos_id')->constrained('documentos')->nullable();
            $table->foreignId('alumnos_id')->constrained('alumnos')->nullable();
            $table->foreignId('profesores_id')->constrained('profesores')->nullable();
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
        Schema::dropIfExists('documentos_asignados');
    }
}
