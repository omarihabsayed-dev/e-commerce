<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($brand): void {
            $brand->slug = \Str::slug($brand->name);
        });

        static::updating(function ($brand): void {
            $brand->slug = \Str::slug($brand->name);
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
