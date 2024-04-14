<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fondo extends Model
{
    use HasFactory;

    protected $table = 'fondo';

    protected $fillable = [
        'Fdistancia',
        'Fzona',
    ];

    public function am()
    {
        return $this->belongsToMany(Am::class, 'amfondo', 'fondo_id', 'am_id')->withTimestamps();
    }

    public function pm()
    {
        return $this->belongsToMany(Pm::class, 'pmfondo', 'fondo_id', 'pm_id')->withTimestamps();
    }
}
