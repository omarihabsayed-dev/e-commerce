<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subCategory): void {
            $subCategory->slug = \Str::slug($subCategory->name);
        });

        static::updating(function ($subCategory): void {
            $subCategory->slug = \Str::slug($subCategory->name);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
