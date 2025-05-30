<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_one',
        'title_two',
        'title_three',
        'title_four',
        'counter_one',
        'counter_two',
        'counter_three',
        'counter_four',
    ];
}