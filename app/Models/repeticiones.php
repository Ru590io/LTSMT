<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class repeticiones extends Model
{
    use HasFactory;

    protected $table = 'repeticion';

    protected $fillable = [
        'Rdistancia',
        'Rsets',
        'Rtiempoesperado',
        'Rrecuperacion',
    ];

    public function am()
    {
        return $this->belongsToMany(Am::class, 'amrepeticiones', 'repeticion_id', 'am_id')->withTimestamps();
    }

    public function pm()
    {
        return $this->belongsToMany(Pm::class, 'pmrepeticiones', 'repeticion_id', 'pm_id')->withTimestamps();
    }
}
