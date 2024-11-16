<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request) {
        $photos = $request->get("images");
        $name = $request->get("name");
        $price = $request->get("price");
    }
}
