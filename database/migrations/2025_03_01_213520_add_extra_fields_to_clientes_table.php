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
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('tipo_documento')->nullable();
            $table->string('numero_ruc')->nullable();
            $table->string('forma_pago')->nullable();
            $table->string('distrito')->nullable();
            $table->string('departamento')->nullable();
            $table->string('provincia')->nullable();
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('clientesc', function (Blueprint $table) {
            $table->dropColumn(['tipo_documento', 'numero_documento', 'ruc', 'forma_pago', 'distrito', 'departamento', 'provincia']);
        });
    }
   
};
