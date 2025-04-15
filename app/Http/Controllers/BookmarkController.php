<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Validator;

class BookmarkController extends Controller
{
    public function createBookmarks($userId, $recipeId) {
        // dd($userId, $recipeId);

        // Validate the incoming IDs
        $validated = Validator::make([
            'user_id' => $userId,
            'recipe_id' => $recipeId
        ], [
            'user_id' => 'required|exists:users,id',
            'recipe_id' => 'required|exists:recipes,id'
        ])->validate();
        // dd($validated);

        // Check if the bookmark already exists
        $existingBookmark = Bookmark::where('user_id', $userId)
                                ->where('recipe_id', $recipeId)
                                ->first();

        if ($existingBookmark) { // if it exists, return with error
            return back()->with('error', 'This recipe is already bookmarked!');
        }

        // after all of this, create new bookmark
        $newBookmark = new Bookmark();
        $newBookmark->user_id = $userId;
        $newBookmark->recipe_id = $recipeId;
        $newBookmark->save();

        return back()->with('success', 'Recipe bookmarked successfully!');

    }

    public function deleteBookmarks($userId, $recipeId) {
        // dd($userId);

        // use where clauses with ids and then delete
        $deleted = Bookmark::where('user_id', $userId)->where('recipe_id', $recipeId)->delete();

        // Check if anything was deleted
        if ($deleted) {
            return back()->with('success', 'Bookmark removed!');
        }

        return back()->with('error', 'Bookmark not found!');

    }
}
