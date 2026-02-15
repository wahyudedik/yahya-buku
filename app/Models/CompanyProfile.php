<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
        'ceo_name',
        'ceo_title',
        'ceo_image_path',
        'vision_mission_description',
        'quote',
        'books_count',
        'authors_count',
        'experience_years',
    ];
}
