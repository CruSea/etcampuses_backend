<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CampusAdmin extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'campusadmin';
    protected $fillable = [
        'campusAdminID',
        'firstName',
        'lastName',
        'email',
        'password',
        'phone',
        'approvedBy'
    ];
}
