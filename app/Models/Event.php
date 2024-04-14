<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [

        'competitors_id',
        'etime_range',
        'edistance',

    ];

    public function competitors(){
        return $this->belongsTo(competitors::class, 'competitors_id');
    }
}
