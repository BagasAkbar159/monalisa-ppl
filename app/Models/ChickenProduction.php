<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChickenProduction extends Model
{
    public const DEFAULT_WEIGHT_PER_CHICKEN = 1.8;

    protected $fillable = [
        'production_date',
        'quantity_chicken',
        'total_weight_kg',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'production_date' => 'date',
            'total_weight_kg' => 'decimal:2',
        ];
    }
}