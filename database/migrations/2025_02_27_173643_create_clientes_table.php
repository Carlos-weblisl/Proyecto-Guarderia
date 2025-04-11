<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->string('nombre'); // Nombre del cliente
            $table->string('email')->unique(); // Email único
            $table->string('telefono')->nullable(); // Teléfono opcional
            $table->timestamps(); // created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
