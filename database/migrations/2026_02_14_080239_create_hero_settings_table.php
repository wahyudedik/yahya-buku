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
        Schema::create('hero_settings', function (Blueprint $table) {
            $table->id();
            
            // Text Content
            $table->string('headline')->nullable()->default('Kami Siap Membantu Anda Dalam Menerbitkan Buku');
            $table->text('subheadline')->nullable();
            $table->string('text_color')->default('#111827'); // gray-900
            
            // CTA Button
            $table->string('cta_text')->nullable()->default('Hubungi Kami');
            $table->string('cta_url')->nullable()->default('#kontak');
            $table->string('cta_color')->default('#002B8F'); // blue-900/custom
            $table->string('cta_text_color')->default('#ffffff');

            // Visuals
            $table->string('background_type')->default('color'); // image, color
            $table->string('background_image_path')->nullable();
            $table->string('background_color')->default('#ffffff');
            
            // Side Image (Certificate/Hero Image)
            $table->string('hero_image_path')->nullable(); // Default placeholder in code if null
            
            // Layout
            $table->string('layout')->default('left-text-right-image'); // left-text-right-image, center-text, right-text-left-image
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_settings');
    }
};
