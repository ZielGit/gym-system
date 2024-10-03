<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'condition',
        'image',
        'status',
    ];

    public function scopeSearch($query, $value)
    {
        if($value) {
            $query->where('plans.name', 'LIKE', "%$value%");
        }
        return $query;
    }
}
