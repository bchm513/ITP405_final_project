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
    public function index() {
        $recipes = Recipe::with([
            'user:id,name', 
            'category:id,name'
        ])->get();
        // dd($recipes);

        return view('recipe-home', [
            'recipes' => $recipes,
        ]);
    }

    public function show($id) {
        // dd($id);
        // given the id passed in, return the recipe
        $recipe = Recipe::find($id);
        // dd($recipe);
        
        return view('recipe-details', ['recipe' => $recipe]);
    }

    public function goToCreate() {

        return view('create-recipe');
    }

    public function store(Request $request) {

        // $validated = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'required|string',
        //     'ingredients' => 'required|string',
        //     'instructions' => 'required|string',
        //     'preparation_time' => 'required|integer|min:0',
        //     'cooking_time' => 'required|integer|min:0',
        //     'servings' => 'required|integer|min:1',
        //     'category_id' => 'required|exists:categories,id'
        // ]);

        // $recipe = Auth::user()->recipes()->create($validated);

        // return redirect()
        //         ->route('recipes.show', $recipe)
        //         ->with('success', 'Recipe created successfully!');
    }

    public function edit(Request $request, Recipe $recipe) {

        // Authorize using policy
        // $this->authorize('update', $recipe);

        // $validated = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'description' => 'nullable|string',
        //     'ingredients' => 'required|string',
        //     'instructions' => 'required|string',
        //     'preparation_time' => 'nullable|integer|min:0',
        //     'cooking_time' => 'nullable|integer|min:0',
        //     'servings' => 'nullable|integer|min:1',
        //     'category_id' => 'nullable|exists:categories,id'
        // ]);

        // $recipe->update($validated);

        // return redirect()
        //         ->route('recipes.show', $recipe)
        //         ->with('success', 'Recipe updated successfully!');
    }

    public function delete(Recipe $recipe) {
        // Authorize using policy
        // $this->authorize('delete', $recipe);

        // $recipe->delete();

        // return redirect()
        //         ->route('home')
        //         ->with('success', 'Recipe deleted successfully!');
    }

}