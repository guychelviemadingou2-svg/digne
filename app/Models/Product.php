<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price',
        'quantity',
        'minimum_quantity',
        'expiry_date'
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function movements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }

    public function getStockStatusAttribute()
    {
        if ($this->quantity == 0) {
            return 'rupture';
        } elseif ($this->quantity <= $this->minimum_quantity) {
            return 'critique';
        }
        return 'normal';
    }
}
