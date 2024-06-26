<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\Rating;

class Review extends Model
{
    use HasFactory;

    public function profiles() {
        return $this->hasMany(Profile::class);
    }

    public function ratings() {
        return $this->hasMany(Rating::class);
     }
}
