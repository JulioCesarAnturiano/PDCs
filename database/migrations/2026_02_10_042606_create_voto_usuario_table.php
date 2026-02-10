<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voto_usuario', function (Blueprint $table) {
            $table->id('id_usuario'); // bigint unsigned auto_increment

            $table->string('nombre_usuario', 150)->unique();
            $table->string('contrasena', 255);
            $table->date('fecha_fin')->nullable();
            $table->string('token', 255)->nullable()->unique();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voto_usuario');
    }
};
