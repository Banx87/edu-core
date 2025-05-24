<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'rounded_text',
        'banner_title',
        'banner_text',
        'banner_image',
        'button_text',
        'button_url',
        'video_url',
        'video_image',
    ];
}