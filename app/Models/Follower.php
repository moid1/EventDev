<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class,'follower_id')->with('profilePicture');
    }
    public function follower_data(){
        return $this->belongsTo(User::class,'user_id')->with('profilePicture');

    }
}
