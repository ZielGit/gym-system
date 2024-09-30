<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $fillable = [
        'day',
        'description',
        'status',
    ];

    public function scopeSearch($query, $value)
    {
        if($value) {
            $query->Where('routines.day', 'LIKE', "%$value%");
            $query->orwhere('routines.description', 'LIKE', "%$value%");
        }
        return $query;
    }
}
