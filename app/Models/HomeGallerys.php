<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeGallerys extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
        'caption',
        'header',
        'embed',
        'button',
    ];
}
