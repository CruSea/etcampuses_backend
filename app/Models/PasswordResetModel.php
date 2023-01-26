<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\PasswordChangeRequested;
use Illuminate\Notifications\Notifiable;

class PasswordResetModel extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'password_resets';
    protected $fillable = [
        'resetKey',
        'email'
    ];

    protected $dispatchesEvents = [
        'created' => PasswordChangeRequested::class,
    ];
}
