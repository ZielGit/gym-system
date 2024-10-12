<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'ruc',
        'name',
        'tax_domicile',
        'email',
        'phone',
        'logo_path',
    ];
}
