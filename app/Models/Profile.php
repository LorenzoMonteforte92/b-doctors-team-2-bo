<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\User;
use App\Models\Message;

class Profile extends Model
{
    use HasFactory;

    public function review() {
        return $this->belongsTo(Review::class);
     }

     public function user() {
        return $this->belongsTo(User::class);
    }

    public function message() {
        return $this->belongsTo(Message::class);
    }
}
