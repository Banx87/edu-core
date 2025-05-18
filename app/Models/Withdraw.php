<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $table = 'withdrawals';
    protected $fillable = [
        'instructor_id',
        'amount',
        'transaction_id',
        'status',
    ];
}