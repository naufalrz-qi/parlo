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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->string('opening_hours')->nullable();
            $table->string('contact_info')->nullable();
            $table->string('type')->nullable();
            $table->bigInteger('price'); // Menambahkan atribut price
            $table->string('image')->nullable(); // Menambahkan atribut image
            $table->unsignedBigInteger('destination_id'); // Menambahkan atribut destination_id untuk relasi
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade'); // Mengatur foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
