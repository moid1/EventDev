<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class)->with('profilePicture');
    }

    public function followingUser(){
        return $this->belongsTo(User::class,'following_id')->with('profilePicture');

    }
}
