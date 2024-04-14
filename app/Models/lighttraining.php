<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lighttraining extends Model
{
    use HasFactory;

    protected $table = 'lighttraining';

    protected $fillable = [
        'ttime',
        'tdistance',
        'users_id'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'users_id');
    }
}
