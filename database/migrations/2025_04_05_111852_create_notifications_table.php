<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table -> enum('state', ['procesando', 'aceptada', 'cancelada', 'en espera', 'completada']) -> default('aceptada');
            $table -> string('description');
            $table -> foreignId('company_id') -> nullable() -> constrained() ->onDelete('set null');
            $table -> foreignId('machine_id') -> constrained();
            $table -> foreignId('worker_id') ->nullable() -> constrained() ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
