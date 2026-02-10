<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voto_tipo_eleccion', function (Blueprint $table) {
            $table->id('id_tipo_eleccion');

            $table->string('nombre', 255);
            $table->string('codigo', 50)->unique();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voto_tipo_eleccion');
    }
};
