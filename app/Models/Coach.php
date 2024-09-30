<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = [
        'document_type',
        'document_number',
        'name',
        'paternal_surname',
        'maternal_surname',
        'email',
        'phone',
        'address',
        'status',
    ];

    public function scopeSearch($query, $value)
    {
        if($value) {
            $query->where('coaches.name', 'LIKE', "%$value%");
            $query->orWhere('coaches.paternal_surname', 'LIKE', "%$value%");
            $query->orWhere('coaches.maternal_surname', 'LIKE', "%$value%");
        }
        return $query;
    }
}
