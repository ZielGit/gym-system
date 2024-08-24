<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'status',
    ];

    protected $hidden = ['password'];
}
