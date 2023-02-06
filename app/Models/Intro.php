<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intro extends Model
{
    use HasFactory;

    protected $table = 'intro';
    protected $fillable = [
        'campusID',
        'title',
        'message',
        'author',
        'authorPosition',
        'image'
    ];
}
