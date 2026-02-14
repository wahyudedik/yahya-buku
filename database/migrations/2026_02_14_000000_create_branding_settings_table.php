<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branding_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo_path')->nullable();
            $table->unsignedInteger('logo_width')->nullable();
            $table->unsignedInteger('logo_height')->nullable();
            $table->enum('logo_position', ['left', 'center', 'right'])->default('left');
            $table->string('favicon_path')->nullable();
            $table->boolean('favicon_enabled')->default(true);
            $table->string('cache_bust_token', 40)->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branding_settings');
    }
};

