<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pmrepeticiones extends Model
{
    use HasFactory;

    protected $fillable = [
        'pm_id',
        'repeticion_id',
    ];

    protected $table = 'pmrepeticiones';
}
