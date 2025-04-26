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
        Schema::create('mission', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('launch_details_id')->constrained('launch_details')->onDelete('cascade');
            $table->foreignId('landing_details_id')->constrained('landing_details')->onDelete('cascade');
            $table->foreignId('spacecraft_id')->constrained('space_crafts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission');
    }
};
