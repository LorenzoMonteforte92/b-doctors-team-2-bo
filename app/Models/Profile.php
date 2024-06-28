<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'photo', 'telephone_number', 'curriculum_vitae', 'bio', 'performance', 'visibility'];

    public function review() {
        return $this->belongsTo(Review::class);
     }

     public function user() {
        return $this->belongsTo(User::class);
    }

    public function message() {
        return $this->belongsTo(Message::class);
    }

    public function specialisations() {
        return $this->belongsToMany(Specialisation::class);
    }

    public function sponsorships() {
        return $this->belongsToMany(Sponsorship::class);
    }
}
