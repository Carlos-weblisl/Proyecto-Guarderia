<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ninos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo'); // Cambiado de 'nombre' a 'nombre_completo'
            $table->date('fecha_nacimiento');
            $table->enum('sexo', ['Masculino', 'Femenino', 'Otro']);
            $table->string('nombre_tutor');
            $table->string('dni_tutor', 8); // Agregado campo DNI del tutor (8 dígitos)
            $table->string('telefono_tutor', 9); // Longitud de 9 caracteres para Perú
            $table->string('email_tutor')->unique()->nullable(); // Agregado correo del tutor
            $table->text('direccion')->nullable();
            $table->text('alergias')->nullable();
            $table->boolean('autorizacion_primeros_auxilios')->default(false);
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ninos');
    }
};
