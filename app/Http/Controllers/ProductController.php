<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Photo;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $name = $request->get("name");
        $price = $request->get("price");
        $description = $request->get("description");
        $category = $request->get("category");
        $subCategory = $request->get("subCategory");
        $sizes = $request->get('sizes');
        $photos = $request->all("images");

        try {
            $product = new Product(["name" => $name, "price" => (float) $price, "description" => $description, "category_id" => (int) $category, "subCategoryName" => $subCategory]);
            $product->save();
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 500);
        }


        // Save each size for the product using the relationship
        foreach ($sizes as $size) {
            $retrievedSize = Size::where("name", $size)->first();
            $product->sizes()->save($retrievedSize);
        }


        for ($i = 0; $i < count($photos["images"]); $i++) {
            $path = $photos["images"][$i]->storeAs('images/' . $name, $name . $i . '.jpg', 'local');
            $photo = new Photo();
            $photo->name = $name . $i . ".jpg";
            $photo->photo_path = $path;
            $photo->product_id = $product->id;

            try {
                $photo->save();
            } catch (\Exception $e) {
                return response()->json(["message" => $e->getMessage()], 500);
            }

            try {
                $product->photos()->save($photo);
            } catch (\Exception $e) {
                return response()->json(["message" => $e->getMessage()], 500);
            }

        }

    }
}


