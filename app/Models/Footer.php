<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $table = 'footers';
    protected $fillable = [
        'campusID',
        'socialMediasCaption',
        'bgColor',
        'contactUsCaption',
        'email',
        'phone',
        'findUsCaption',
        'termsAndConditions',
        'termsAndConditionsCaption',
        'mapLink',
        'copyrightCaption'
    ];
}
