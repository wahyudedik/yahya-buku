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
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('ceo_name')->nullable();
            $table->string('ceo_title')->nullable();
            $table->string('ceo_image_path')->nullable();
            $table->text('vision_mission_description')->nullable();
            $table->text('quote')->nullable();
            $table->string('books_count')->default('0');
            $table->string('authors_count')->default('0');
            $table->string('experience_years')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};
