<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show($id) {

        // dd($id);
        $categoryInfo = Category::with(['recipes.user'])->find($id);
        // dd($categoryInfo);

        return view('category-details', ['categoryInfo' => $categoryInfo]);
    }

    public function categoryList() {
        
        $categories = Category::all();
        // dd($categories);

        return view('category-list', ['categories' => $categories]);
    }
}
