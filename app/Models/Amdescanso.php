<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amdescanso extends Model
{
    use HasFactory;

    protected $table = 'amdescanso';

    protected $fillable = [
        'am_id',
        'descanso_id',
    ];
}
