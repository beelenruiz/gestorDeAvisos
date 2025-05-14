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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table -> foreignId('worker_id') -> constrained() ->onDelete('set null');
            $table -> foreignId('notification_id') -> constrained() -> onDelete('cascade');
            $table -> foreignId('machine_id') -> constrained() ->onDelete('set null');
            $table -> integer('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
