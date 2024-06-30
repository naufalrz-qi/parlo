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
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('id')->primary(); // Ubah kolom id menjadi string
            $table->unsignedBigInteger('user_id'); // Relasi dengan users
            $table->unsignedBigInteger('destination_id'); // Relasi dengan destinations
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->bigInteger('total_price');
            $table->string('status')->default('pending'); // Status booking (pending, approved, rejected)
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
