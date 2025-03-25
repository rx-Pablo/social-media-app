<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Asegúrate de que el tipo de columna coincida con el que ya existe (string, text, etc.)
            $table->string('phone')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Si deseas revertir la columna a "no nullable"
            $table->string('phone')->nullable(false)->change();
        });
    }
};
