<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'time',
        'topic',
        'venue',
        'event_id',
        'publish',
        'speaker_id'
    ];
}
