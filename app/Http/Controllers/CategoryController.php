<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
}
