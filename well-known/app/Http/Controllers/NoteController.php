<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new note for the logged-in user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string|max:20000',
        ]);

        $note = $request->user()->notes()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json(['note' => $note]);
    }

    /**
     * Update a note. Only the owner may edit it.
     */
    public function update(Request $request, Note $note)
    {
        if ((int) $note->user_id !== (int) $request->user()->id) {
            abort(403);
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string|max:20000',
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json(['note' => $note]);
    }

    /**
     * Delete a note. Only the owner may delete it.
     */
    public function destroy(Request $request, Note $note)
    {
        if ((int) $note->user_id !== (int) $request->user()->id) {
            abort(403);
        }

        $note->delete();

        return response()->json(['deleted' => true]);
    }
}
