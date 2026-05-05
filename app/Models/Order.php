<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'chicken_price_catalog_id',
        'order_code',
        'order_date',
        'quantity_chicken',
        'estimated_weight_kg',
        'price_per_kg',
        'estimated_total',
        'status',
        'notes',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'order_date' => 'date',
            'estimated_weight_kg' => 'decimal:2',
            'price_per_kg' => 'decimal:2',
            'estimated_total' => 'decimal:2',
        ];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function chickenPriceCatalog()
    {
        return $this->belongsTo(ChickenPriceCatalog::class);
    }
}