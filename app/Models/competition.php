<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class competition extends Model
{
    use HasFactory;

    protected $table = 'competition';

    protected $fillable = [
        'cname',
        'cdate',
        'ctime',
        'cplace',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'competitors', 'competition_id', 'users_id')->withTimestamps();
    }
}
