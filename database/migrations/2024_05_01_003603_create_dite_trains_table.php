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
        Schema::create('dite_trains', function (Blueprint $table) {
            $table->id();
            $table->string('height');
            $table->string('weight');
            $table->string('notes');
            $table->string('connection');
            $table->boolean('read')->default(1);
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dite_trains');
    }
};
