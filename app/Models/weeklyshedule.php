<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class weeklyshedule extends Model
{
    use HasFactory;

    protected $table = 'weeklyshedule';

    protected $fillable = [
        'wstart_date',
        'wend_date',
        'wname',
        'users_id'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'users_id');
    }

    public function days(){
        return $this->hasMany(day::class, 'weeklyshedule_id');
    }
}
