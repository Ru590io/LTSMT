<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amrepeticiones extends Model
{
    use HasFactory;

    protected $fillable = [
        'am_id',
        'repeticion_id',
    ];

    protected $table = 'amrepeticiones';
}
