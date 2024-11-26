<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    protected $fillable = ["name", "price", "description", "category_id", "subcategory_name"];
    protected $hidden = ["photos", "created_at", "updated_at"];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    protected function subcategoryName()
    {
        return Attribute::make(set: fn(string $value) => ucfirst($value));
    }

}
