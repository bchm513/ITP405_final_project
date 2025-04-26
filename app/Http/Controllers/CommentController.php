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

    public function deleteComments($commentId) {

        // dd($commentId);
        $deleted = Comment::where('id', $commentId)->delete();

        // Check if anything was deleted
        if ($deleted) {
            return back()->with('success', 'Bookmark removed!');
        }

        return back()->with('error', 'Bookmark not found!');
    }

    public function goToEdit($commentId) {

        // dd($commentId);
        $comment = Comment::with(['recipe'])->find($commentId); // generate comment from id
        // dd($comment);

        return view('comment-edit', ['comment' => $comment]);

    }

    public function editComment(Request $request) {
        
        
        $validated = $request->validate([
            'comment_id' => 'required|exists:comments,id',
            'recipe_id' => 'required|exists:recipes,id',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1000'
        ]);
        // dd($validated);

        $commentToEdit = Comment::find($validated['comment_id']); // find the comment given the id
        // dd($commentToEdit);

        $commentToEdit->update(collect($validated)->except('comment_id')->all()); // update all the fields except for id
        // dd($commentToEdit);

        return redirect()->route('profile', )
                ->with('success', 'Comment updated successfully!');

    }
}
