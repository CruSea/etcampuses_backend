<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampusAdmin extends Model
{
    use HasFactory;

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
