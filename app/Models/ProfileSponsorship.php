<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class ProfileSponsorship extends Model
{
    use HasFactory;

    protected $table = 'profile_sponsorship';

    protected $fillable = [
        'profile_id',
        'sponsorship_id',
        'start_date',
        'end_date'
    ];


}