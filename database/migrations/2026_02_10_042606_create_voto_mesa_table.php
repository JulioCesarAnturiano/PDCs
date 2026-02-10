<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voto_mesa', function (Blueprint $table) {
            $table->id('id_mesa'); // bigint unsigned auto_increment

            $table->string('codigo', 50)->unique();
            $table->string('nombre', 255)->nullable();
            $table->text('descripcion')->nullable();

            $table->integer('numero_personas')->default(0);

            $table->unsignedBigInteger('id_recinto');

            $table->boolean('activa')->default(true);

            $table->timestamps();
            $table->softDeletes();

            // Índices (MUL)
            $table->index('id_recinto');
            $table->index('activa');

            // Relación con voto_geografico (RECINTO)
            $table->foreign('id_recinto')
                ->references('id_geografico')
                ->on('voto_geografico')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voto_mesa');
    }
};
