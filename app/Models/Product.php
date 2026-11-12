<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model): void {
            $model->slug = \Str::slug($model->name);
        });

        static::updating(function ($model): void {
            $model->slug = \Str::slug($model->name);
        });
    }

    protected $casts = [
        'hot_deals' => 'boolean',
        'featured' => 'boolean',
        'special_offer' => 'boolean',
        'special_deal' => 'boolean',
        'status' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
