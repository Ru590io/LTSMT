<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class competitors extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'competition_id',
    ];

    protected $table = 'competitors';

    public function users() {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function competition() {
        return $this->belongsTo(competition::class, 'competition_id');
    }

    public function events(){
        return $this->hasMany(Event::class, 'competitors_id');
    }
}
