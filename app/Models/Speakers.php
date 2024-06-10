<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speakers extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
        'name',
        'profession',
        'bio',
        'event_id',
        'keynote',
        'publish',
        'order_number',
    ];
}
