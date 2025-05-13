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
            $table->date('launch_date');
            $table->string('launch_site_name');
            $table->decimal('launch_site_latitude', 10, 7);
            $table->decimal('launch_site_longitude', 10, 7);
            $table->date('landing_date');
            $table->string('landing_site_name');
            $table->decimal('landing_site_latitude', 10, 7);
            $table->decimal('landing_site_longitude', 10, 7);
            $table->foreignId('spacecraft_id')->constrained('space_crafts');
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
