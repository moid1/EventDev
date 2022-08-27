<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function profilePicture()
    {
        return $this->hasOne(ProfileImage::class);
    }

    public function followers()
    {
        return $this->hasMany(Follower::class);
    }

    public function followersCount()
    {
        return $this->hasMany(Follower::class)->count();
    }

    public function following()
    {
        return $this->hasMany(Following::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function getLastMessage()
    {
      return  Message::where('from_user',Auth::id())
        ->orderBy('updated_at', 'desc')
        ->get()
        ->unique('to_user');
    }

    public function messages()
    {
        return $this->hasMany(Message::class,'from_user');
    }

   
}
