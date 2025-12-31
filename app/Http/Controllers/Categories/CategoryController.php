<?php

namespace App\Http\Controllers\Categories;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    public function categories()
    {
        try {
            $categories = Category::all();
            return response()->json([
                "success" => true,
                "categories" => $categories,
                "errors" => null
            ], 200);
        } catch (\Exception $errors) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => $errors->getMessage(),
            ], 422);
        }
    }

    public function subCategory($category_id)
    {
        try {
            $subCategories = Category::where('id' , $category_id)->with('sub_category')->first();
            return response()->json([
                "success" => true,
                "sub-categories" => $subCategories,
                "errors" => null,
            ], 200);
        } catch (\Exception $errors) {
            return response()->json([
                "success" => false,
                "data" => null,
                "errors" => $errors->getMessage(),
            ], 422);
        }
    }
}
