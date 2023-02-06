<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registration';
    protected $fillable = [
        'campusID',
        'title',
        'description',
        'firstNameCaption',
        'lastNameCaption',
        'cityCaption',
        'languageCaption',
        'sexCaption',
        'maleCaption',
        'femaleCaption',
        'phoneNumberCaption',
        'isHostAvailableCaption',
        'yesCaption',
        'noCaption',
        'buttonName',
        'bgColor'
    ];
}
