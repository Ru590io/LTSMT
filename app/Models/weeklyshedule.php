<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class weeklyshedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'weeklyshedule';

    protected $fillable = [
        'wstart_date',
        'wend_date',
        'wname',
        'users_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'users_id');
    }

    public function days(){
        return $this->hasMany(day::class, 'weeklyshedule_id');
    }
}
