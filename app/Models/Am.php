<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Am extends Model
{
    use HasFactory;

    protected $table = 'am';

    protected $fillable = [
        'aam',
    ];

    public function pm()
    {
        return $this->belongsToMany(Pm::class, 'sessions', 'am_id', 'pm_id')->withPivot('days_id')->withTimestamps();
    }

    public function days()
    {
        return $this->belongsToMany(day::class, 'sessions', 'am_id', 'days_id')->withPivot('pm_id')->withTimestamps();
    }

    public function descanso()
    {
        return $this->belongsToMany(descanso::class, 'amdescanso', 'am_id', 'descanso_id')->withTimestamps();
    }

    public function fondo()
    {
        return $this->belongsToMany(fondo::class, 'amfondo', 'am_id', 'fondo_id')->withTimestamps();
    }

    public function repeticion()
    {
        return $this->belongsToMany(repeticiones::class, 'amrepeticiones', 'am_id', 'repeticion_id')->withTimestamps();
    }
}
