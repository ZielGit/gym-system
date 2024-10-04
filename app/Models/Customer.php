<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function planDetails(): HasMany
    {
        return $this->hasMany(PlanDetails::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
