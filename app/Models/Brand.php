<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

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
}
