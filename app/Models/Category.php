<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category): void {
            $category->slug = \Str::slug($category->name);
        });

        static::updating(function ($category): void {
            $category->slug = \Str::slug($category->name);
        });
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
