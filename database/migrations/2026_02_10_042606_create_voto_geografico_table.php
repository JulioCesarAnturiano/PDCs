<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voto_geografico', function (Blueprint $table) {
            $table->id('id_geografico'); // bigint unsigned auto_increment

            $table->string('nombre', 255);
            $table->string('codigo', 50)->unique();
            $table->string('ubicacion', 255)->nullable();

            $table->enum('tipo', ['PAIS', 'CIUDAD', 'MUNICIPIO', 'LOCALIDAD', 'RECINTO']);

            $table->unsignedBigInteger('fk_id_geografico')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // En tu DESCRIBE aparece "MUL" en tipo
            $table->index('tipo');

            // Autorelación jerárquica
            $table->foreign('fk_id_geografico')
                ->references('id_geografico')
                ->on('voto_geografico')
                ->nullOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voto_geografico');
    }
};
