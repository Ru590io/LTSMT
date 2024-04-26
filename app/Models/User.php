<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'is_active',
        'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
    $this->notify(new CustomResetPasswordNotification($token));
    }

    public function hasRole($role)
    {
    return $this->role === $role;
    //$this->roles->contains('name', $role);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
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

    /*public function passwordresettoken(){
        return $this->hasMany(Passwordresettoken::class, 'users_id');
    }

    public function passwordreset(){
        return $this->hasMany(Passwordreset::class, 'users_id');
    }*/

    public function accesscode(){
        return $this->hasMany(AccessCode::class, 'users_id');
    }

    public function competition(){
        return $this->belongsToMany(competition::class, 'competitors', 'users_id', 'competition_id')->withTimestamps();
    }
}
