<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Comment;
use Auth;

class CommentController extends Controller
{
    public function goToComment($userId, $recipeId) {

        $recipe = Recipe::find($recipeId);

        return view('comment-create', ['userId' => $userId, 'recipe' => $recipe]);

    }

    public function addComment(Request $request) {
        // dd($request);

        $validated = $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1000'
        ]);

        // dd($validated);

        $newComment = Comment::create([
            'user_id' => Auth::user()->id, // Automatically assign current user
            'recipe_id' => $validated['recipe_id'],
            'rating' => $validated['rating'],
            'content' => $validated['content']
        ]);

        return redirect()->route('recipe-details', ['id' => $validated['recipe_id']])
                         ->with('success', 'Thank you for your review!');

    }
}
