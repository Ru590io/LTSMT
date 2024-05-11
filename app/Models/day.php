<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class day extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'days';

    protected $fillable = [
        'day',
        'notes',
        'weeklyshedule_id'
    ];

    public function weeklyshedule(){
        return $this->belongsTo(weeklyshedule::class, 'weeklyshedule_id');
    }

    public function ams(){
        return $this->belongsToMany(Am::class, 'sessions', 'days_id', 'am_id')->withPivot('pm_id')->withTimestamps();
    }

    public function pms(){
        return $this->belongsToMany(Pm::class, 'sessions', 'days_id', 'pm_id')->withPivot('am_id')->withTimestamps();
    }

}
