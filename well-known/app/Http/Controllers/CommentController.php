<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        // Must be logged in to comment — guests get redirected to the
        // login page (and back here afterwards) instead of being able to
        // submit.
        $this->middleware('auth');
    }

    public function store(Request $request, $slug)
    {
        $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $post = Post::whereSlug($slug)->firstOrFail();
        $user = Auth::user();

        Comment::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            // Kept filled in for display/backward-compatibility with the
            // existing schema, sourced straight from the logged-in user
            // rather than free-typed, since only real accounts can comment.
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo_id ?? '',
            'body' => $request->body,
            'is_active' => 1,
        ]);

        return back()->with('comment_success', 'Your comment has been posted.');
    }
}
