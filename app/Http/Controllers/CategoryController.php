<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function add(Request $request)
    {

        //Find out why you're not able to use the policy

        if ($request->user()->can("create", Category::class)) {
            try {
                Category::create(["name" => $request->get("categoryName")]);

                return response()->json(["message" => "Success"], 200);
            } catch (\Exception $e) {
                return response()->json(["message" => $e->getMessage()], 500);
            }
        }

        return abort(403);
    }




}
