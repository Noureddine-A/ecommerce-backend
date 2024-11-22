<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $fillable = ["photo_path", "product_id"];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
