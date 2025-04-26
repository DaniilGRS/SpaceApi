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
        Schema::create('crew', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('spacecraft_id');
            $table->string('name');
            $table->string('role');
            $table->timestamps();
            $table->foreign('spacecraft_id')->references('spacecraft_id')->on('spacecraft')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crew');
    }
};
