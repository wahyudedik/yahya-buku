<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    protected $fillable = [
        'description',
        'copyright_text',
        'created_by_text',
        'created_by_url',
    ];
}
