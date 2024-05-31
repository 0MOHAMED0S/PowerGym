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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->text('facebooklink')->nullable();
            $table->text('instgramlink')->nullable();
            $table->text('xlink')->nullable();
            $table->text('location');
            $table->text('timeopen')->nullable();
            $table->text('daysopen')->nullable();
            $table->bigInteger('phone');
            $table->bigInteger('whatsapp')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
