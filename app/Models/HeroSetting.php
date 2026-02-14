<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSetting extends Model
{
    protected $fillable = [
        'headline',
        'subheadline',
        'text_color',
        'cta_text',
        'cta_url',
        'cta_color',
        'cta_text_color',
        'background_type',
        'background_image_path',
        'background_color',
        'hero_image_path',
        'layout',
        'is_active',
        'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
