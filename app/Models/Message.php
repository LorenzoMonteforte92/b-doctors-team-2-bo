<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'email', 'date'];

    public function profiles() {
        return $this->hasMany(Profile::class);
    }
}
