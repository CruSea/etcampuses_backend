<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $table = 'campuses';
    protected $fillable = [
        'services_Title',
        'teams_Title',
        'teams_Description',
        'leaders_Title',
        'leaders_BgColor',
        'gallery_Title',
        'isBlocked',
        'url',
        'isPublished',
        'owner'        
    ];
}
