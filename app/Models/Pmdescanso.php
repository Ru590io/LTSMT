<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pmdescanso extends Model
{
    use HasFactory;

    protected $table = 'pmdescanso';

    protected $fillable = [
        'pm_id',
        'descanso_id',
    ];

}
