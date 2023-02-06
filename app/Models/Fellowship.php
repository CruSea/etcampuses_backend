<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fellowship extends Model
{
    use HasFactory;

    protected $table = 'fellowships';
    protected $fillable = [
        'campusID',
        'title',
        'members',
        'membersCaption',
        'teams',
        'teamsCaption',
        'services',
        'servicesCaption',
        'image',
        'bgColor'
    ];
}