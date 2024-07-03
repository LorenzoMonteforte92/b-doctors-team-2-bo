<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function profile() {
        return $this->belongsTo(Profile::class);
    }

    public function rating() {
        return $this->belongsTo(Rating::class);
     }

     protected $fillable = ['name','description','profile_id','rating_id'];
}
