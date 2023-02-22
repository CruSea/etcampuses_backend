<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'phone',
        'promotedBy',
        'profilePicture',
        'theme',
        'status',
        'lastActivityTimestamp',
        'lastUsedDevice'
    ];

}
