<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class competitors extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'competition_id',
    ];

    protected $table = 'competitors';

    public function events(){
        return $this->hasMany(Event::class, 'competitors_id');
    }
}
