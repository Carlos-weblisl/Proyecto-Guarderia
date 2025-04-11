<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoToPlanesTable extends Migration
{
    public function up()
    {
        Schema::table('planes', function (Blueprint $table) {
            if (!Schema::hasColumn('planes', 'tipo')) {
                $table->string('tipo')->after('nombre')->nullable(false);
            }
        });
    }

    public function down()
    {
        Schema::table('planes', function (Blueprint $table) {
            if (Schema::hasColumn('planes', 'tipo')) {
                $table->dropColumn('tipo');
            }
        });
    }
}
