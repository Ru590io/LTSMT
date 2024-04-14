<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sessions extends Model
{
    use HasFactory;

    protected $fillable = [
        'am_id',
        'pm_id',
        'days_id',
    ];

    protected $table = 'sessions';
}
