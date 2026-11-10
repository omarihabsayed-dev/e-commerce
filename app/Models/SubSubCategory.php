<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
