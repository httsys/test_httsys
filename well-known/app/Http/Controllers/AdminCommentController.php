<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::with(['post', 'user'])
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('comments.index', compact('comments'));
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $comment->update([
            'body' => $request->body,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('comments.index')->with('comment_success', 'Comment updated successfully!');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('comment_success', 'Comment deleted successfully!');
    }
}
