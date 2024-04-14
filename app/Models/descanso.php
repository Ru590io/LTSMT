<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class descanso extends Model
{
    use HasFactory;

    protected $table = 'descanso';

    protected $fillable = [
        'ddescanso',
    ];

    public function am()
    {
        return $this->belongsToMany(Am::class, 'amdescanso', 'descanso_id', 'am_id')->withTimestamps();
    }

    public function pm()
    {
        return $this->belongsToMany(Pm::class, 'pmdescanso', 'descanso_id', 'pm_id')->withTimestamps();
    }

}
