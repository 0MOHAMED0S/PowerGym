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
        Schema::create('subscribes', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->nullable();
            $table->string('user_name');
            $table->string('user_id')->nullable();
            $table->foreignId('package_id')->references('id')->on('packages')->cascadeOnDelete();
            $table->string('amount');
            $table->string('currency')->nullable();
            $table->string('payer_name')->nullable();
            $table->string('payer_email')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_method')->nullable();
            $table->boolean('active')->default(1);
            $table->date('end_at')->nullable();
            $table->bigInteger('phone_number')->nullable();
            // $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribes');
    }
};
