<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pm extends Model
{
    use HasFactory;

    protected $table = 'pm';

    protected $fillable = [
        'ppm',
    ];

    public function ams()
    {
        return $this->belongsToMany(Am::class, 'sessions', 'pm_id', 'am_id')->withPivot('days_id')->withTimestamps();
    }

    public function days()
    {
        return $this->belongsToMany(day::class, 'sessions', 'pm_id', 'days_id')->withPivot('am_id')->withTimestamps();
    }

    public function descansos()
    {
        return $this->belongsToMany(descanso::class, 'pmdescanso', 'pm_id', 'descanso_id')->withTimestamps();
    }

    public function fondos()
    {
        return $this->belongsToMany(fondo::class, 'pmfondo', 'pm_id', 'fondo_id')->withTimestamps();
    }

    public function repeticiones()
    {
        return $this->belongsToMany(repeticiones::class, 'pmrepeticiones', 'pm_id', 'repeticion_id')->withTimestamps();
    }

}
