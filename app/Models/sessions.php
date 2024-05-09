<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class sessions extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'am_id',
        'pm_id',
        'days_id',
    ];

    protected $table = 'sessions';

    public function am()
    {
        return $this->belongsTo(Am::class, 'am_id');
    }

    public function pm()
    {
        return $this->belongsTo(Pm::class, 'pm_id');
    }

    public function day()
    {
        return $this->belongsTo(Day::class, 'days_id');
    }
}
