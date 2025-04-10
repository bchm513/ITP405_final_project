<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::with([
            'user:id,name', 
            'category:id,name'
        ])->get();
        // dd($recipes);

        return view('recipe-home', [
            'recipes' => $recipes,
        ]);

    }

    public function goToCreate()
    {
        return view('create-recipe');
    }

    public function chefs() {
        return view('chef-details');
    }

    public function categories() {
        return view('category-details');
    }

    public function categoryList() {
        
        $categories = Category::all();
        // dd($categories);

        return view('category-list', ['categories' => $categories]);
    }

    public function chefList() {
        
        $chefs = User::with(['recipes'])->get();
        // dd($chefs);

        return view('chef-list', ['chefs' => $chefs]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'preparation_time' => 'nullable|integer|min:0',
            'cooking_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $recipe = Auth::user()->recipes()->create($validated);

        return redirect()
                ->route('recipes.show', $recipe)
                ->with('success', 'Recipe created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return view('recipe-details');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        // Authorize using policy
        $this->authorize('update', $recipe);

        $categories = Category::all();
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        // Authorize using policy
        $this->authorize('update', $recipe);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'preparation_time' => 'nullable|integer|min:0',
            'cooking_time' => 'nullable|integer|min:0',
            'servings' => 'nullable|integer|min:1',
            'category_id' => 'nullable|exists:categories,id'
        ]);

        $recipe->update($validated);

        return redirect()
                ->route('recipes.show', $recipe)
                ->with('success', 'Recipe updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        // Authorize using policy
        $this->authorize('delete', $recipe);

        $recipe->delete();

        return redirect()
                ->route('home')
                ->with('success', 'Recipe deleted successfully!');
    }
}