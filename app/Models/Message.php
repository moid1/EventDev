<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = "messages";

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user')->with('profilePicture');;
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user')->with('profilePicture');;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'to_user')->with('profilePicture');
    }
}
