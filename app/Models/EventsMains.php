<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsMains extends Model
{
    use HasFactory;
    protected $fillable = [
        'header',
        'caption', 
        'path',
    ];
}
