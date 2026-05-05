<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChickenPriceCatalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_per_kg',
        'effective_date',
        'is_active',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'price_per_kg' => 'decimal:2',
            'effective_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function getActive(): ?self
    {
        return self::where('is_active', true)
            ->orderByDesc('effective_date')
            ->orderByDesc('id')
            ->first();
    }
}