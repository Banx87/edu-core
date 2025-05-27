<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedInstructor extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'instructor_id',
        'button_text',
        'button_url',
        'featured_courses',
        'instructor_image',
    ];
}
