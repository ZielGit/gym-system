<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
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

    public function scopeSearch($query, $value)
    {
        if($value) {
            $query->where('customers.name', 'LIKE', "%$value%");
            $query->orWhere('customers.lastname', 'LIKE', "%$value%");
        }
        return $query;
    }
}
