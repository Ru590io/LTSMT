<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'urole',
        'ufirst_name',
        'ulast_name',
        'uemail',
        'uphone_number',
        'upassword',
        'uis_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'upassword',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lighttraining(){
        return $this->hasMany(lighttraining::class, 'users_id');
    }

    public function weeklyshedule(){
        return $this->hasMany(weeklyshedule::class, 'users_id');
    }

    public function passwordresettoken(){
        return $this->hasMany(Passwordresettoken::class, 'users_id');
    }

    public function passwordreset(){
        return $this->hasMany(Passwordreset::class, 'users_id');
    }

    public function competition(){
        return $this->belongsToMany(competition::class, 'competitors', 'users_id', 'competition_id')->withTimestamps();
    }
}
