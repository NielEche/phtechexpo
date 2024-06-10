<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutGallerys extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
        'caption',
    ];
}
