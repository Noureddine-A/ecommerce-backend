<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Photo;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;

class ProductController extends Controller
{
    public function create(Request $request)
    {

        if ($request->user()->can("create", Product::class)) {
            $name = $request->get("name");
            $price = $request->get("price");
            $description = $request->get("description");
            $category = $request->get("category");
            $subCategory = $request->get("subCategory");
            $sizes = $request->get('sizes');
            $photos = $request->all("images");

            Validator::make($request->all(), [
                "name" => ["required", "string", "unique:products"],
                "price" => ["required", "numeric"],
                "description" => ["required", "string"],
                "category" => ["required", "numeric"],
                "subCategory" => ["required"],
                "sizes" => ["required"]
            ], $messages = [
                    "name" => "Name is required.",
                    "price" => "Price is required.",
                    "description" => "Description is required.",
                    "category" => "Category is required.",
                    "Subcategory" => "Subcategory is required.",
                    "sizes" => "Size is required.",
                ])->validate();

            //Check from the b64 string whether the string starts with the characters that indicate that the uploaded file is a JPG or PNG
            Validator::validate($photos["images"], ["required", "starts_with:iVBORw0KGg,/9j/4"], ["Photo is required."]);

            $product = new Product(["name" => $name, "price" => (float) $price, "description" => $description, "category_id" => (int) $category, "subCategoryName" => $subCategory]);
            $product->save();

            foreach ($sizes as $size) {
                $retrievedSize = Size::where("name", $size)->first();
                $product->sizes()->save($retrievedSize);
            }


            //Loop through the images, decode them and then make a Photo model that is associated with the created Product
            for ($i = 0; $i < count($photos["images"]); $i++) {
                $base64 = $photos["images"][$i];
                $path = 'images/' . $name . "/" . $name . $i . '.png';
                Storage::put($path, base64_decode($base64));

                $photo = new Photo();
                $photo->name = $name . $i;
                $photo->photo_path = $path;
                $photo->product_id = $product->id;
                $photo->save();

                try {
                    $product->photos()->save($photo);
                } catch (\Exception $e) {
                    return response()->json(["message" => $e->getMessage()], 500);
                }


            }
        } else {
            return response()->json(["message" => "You're not authorized to perform this action."], 403);
        }

    }


}

