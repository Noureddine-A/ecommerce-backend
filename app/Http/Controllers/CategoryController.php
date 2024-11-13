<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function add(Request $request)
    {

        if ($request->user()->can("create", Category::class)) {
            try {
                Category::create(["name" => $request->get("categoryName")]);

                return response()->json(["message" => "Category successfully added."], 200);
            } catch (\Exception $e) {
                return response()->json(["message" => $e->getMessage()], 500);
            }
        }

        return response()->json(["message" => "You're not authorized to perform this action."], 403);
    }

    public function getCategories(Request $request)
    {
        $categories = Category::all();

        if (count($categories) == 0) {
            return response()->json(["message" => "No categories exist. Add one first before you can add a product."], 200);
        }

        return response()->json(["categories" => $categories], 200);
    }




}
