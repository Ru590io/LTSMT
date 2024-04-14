<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amfondo extends Model
{
    use HasFactory;

    protected $table = 'amfondo';

    protected $fillable = [
        'am_id',
        'fondo_id',
    ];

}
