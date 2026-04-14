<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'plate_number',
        'type',
        'brand',
        'capacity_kg',
        'status',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'capacity_kg' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }
}