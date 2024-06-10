<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programs extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
        'header',
        'caption',
    ];
}
