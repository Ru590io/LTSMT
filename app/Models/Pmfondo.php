<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pmfondo extends Model
{
    use HasFactory;

    protected $fillable = [
        'pm_id',
        'fondo_id',
    ];

    protected $table = 'pmfondo';
}
