<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'document_type',
        'document_number',
        'name',
        'paternal_surname',
        'maternal_surname',
        'email',
        'phone',
        'password',
        'profile_photo_url',
        'status',
    ];

    protected $hidden = ['password'];
}
