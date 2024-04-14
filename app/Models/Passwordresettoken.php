<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passwordresettoken extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'email',
        'token',
    ];

    public function users(){
        return $this->belongsTo(User::class, 'users_id');
    }
}
