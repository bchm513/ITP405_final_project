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

        $categories = Category::all();
        // dd($categories);

        return view('create-recipe', ['categories' => $categories]);
    }

    public function store(Request $request) {

        // dd($request);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'preparation_time' => 'required|integer|min:0',
            'cooking_time' => 'required|integer|min:0',
            'servings' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id'
        ]);

        // dd(Auth::user()->id);

        
        // Create recipe with authenticated user
        $newRecipe = Recipe::create([
            'user_id' => Auth::user()->id, // Automatically assign current user
            'title' => $validated['title'],
            'description' => $validated['description'],
            'ingredients' => $validated['ingredients'],
            'instructions' => $validated['instructions'],
            'preparation_time' => $validated['preparation_time'],
            'cooking_time' => $validated['cooking_time'],
            'servings' => $validated['servings'],
            'category_id' => $validated['category_id']
        ]);
        
        
        // dd($newRecipe);

        return redirect()->route('recipe-home')->with('success', 'Recipe created successfully!');

        // $recipe = Auth::user()->recipes()->create($validated);

        // return redirect()
        //         ->route('recipes.show', $recipe)
        //         ->with('success', 'Recipe created successfully!');
    }

    public function goToEdit($id) {

        $recipe = Recipe::find($id);// generate recipe from id
        // dd($recipe);
        $categories = Category::all(); // generate categories too

        return view('recipe-edit', ['recipe' => $recipe, 'categories' => $categories]);

    }

    public function edit(Request $request) {

        // dd($request->recipe_id);

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

        // dd($validated);

        $recipeToEdit = Recipe::find($request->recipe_id); // find the recipe given the id
        // dd($recipeToEdit);

        $recipeToEdit->update(collect($validated)->except('id')->all()); // update all the fields except for id
        // dd($recipeToEdit);

        return redirect()->route('profile', )
                ->with('success', 'Recipe updated successfully!');
    }

    public function delete($id) {
        
        // all authentication would have already happened so no issue there
        // dd($id);
        $recipeToDelete = Recipe::find($id);
        // dd($recipeToDelete);

        $recipeToDelete->delete();

        return redirect()->route('profile')
                ->with('success', 'Recipe deleted successfully!');
    }

}