<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = [
        'campusID',
        'firstName',
        'lastName',
        'city',
        'language',
        'sex',
        'phone',
        'isHostAvailable',
        'church'
    ];
}
