<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'document_type',
        'document_number',
        'name',
        'lastname',
        'email',
        'phone',
        'address',
        'status',
    ];
}
