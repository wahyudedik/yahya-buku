<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BrandingSetting extends Model
{
    protected $fillable = [
        'logo_path',
        'logo_width',
        'logo_height',
        'logo_position',
        'favicon_path',
        'favicon_enabled',
        'cache_bust_token',
        'updated_by',
    ];

    protected $casts = [
        'favicon_enabled' => 'boolean',
        'logo_width' => 'integer',
        'logo_height' => 'integer',
    ];

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

