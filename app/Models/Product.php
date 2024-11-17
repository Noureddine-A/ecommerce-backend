<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "price", "description", "category_id", "subCategoryName"];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    public function photos() {
        return $this->hasMany(Photo::class);
    }
}
