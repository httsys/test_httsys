<?php

namespace App\Http\Controllers;

use App\Services\TicTacToeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * JSON endpoints behind the Tic Tac Toe page (the page itself is rendered by
 * MiniGameController@show like every other mini game). Playing for points
 * needs a login; the offline two-player mode runs entirely in the browser.
 */
class TicTacToeController extends Controller
{
    protected $ttt;

    public function __construct(TicTacToeService $ttt)
    {
        $this->middleware('auth');
        $this->ttt = $ttt;
    }

    /** Start a match against the computer. */
    public function startAi(Request $request)
    {
        $request->validate(['size' => 'required|integer|in:3,5,7']);

        return $this->respond($this->ttt->startAi(Auth::user(), (int) $request->input('size'), $request->ip()));
    }

    /** Open an online room for some points (the answer carries the share code). */
    public function createRoom(Request $request)
    {
        $request->validate([
            'size' => 'required|integer|in:3,5,7',
            'stake' => 'required|integer|min:1|max:100000000',
        ]);

        return $this->respond($this->ttt->createRoom(
            Auth::user(),
            (int) $request->input('size'),
            (int) $request->input('stake'),
            $request->ip()
        ));
    }

    /** The friend typed a code: show him the room and its points (nothing is paid yet). */
    public function previewRoom(Request $request)
    {
        $request->validate(['code' => 'required|string|max:20']);

        $out = $this->ttt->previewRoom(Auth::user(), $request->input('code'));

        if ($out['error']) {
            return response()->json(['ok' => false, 'message' => $out['error']], 422);
        }

        return response()->json([
            'ok' => true,
            'room' => $this->ttt->roomInfo($out['match'], $out['balance'], $out['rejoin']),
        ]);
    }

    /** The friend pressed Cancel in the dialog: tell the host. */
    public function declineRoom(Request $request)
    {
        $request->validate(['code' => 'required|string|max:20']);

        $this->ttt->declineRoom(Auth::user(), $request->input('code'));

        return response()->json(['ok' => true]);
    }

    /** The friend pressed Join Game: his points are taken and the match starts. */
    public function joinRoom(Request $request)
    {
        $request->validate(['code' => 'required|string|max:20']);

        return $this->respond($this->ttt->joinRoom(Auth::user(), $request->input('code'), $request->ip()));
    }

    /** Polled by the page every second or two. */
    public function state($id)
    {
        $match = $this->ttt->state(Auth::user(), (int) $id);
        if (! $match) {
            return response()->json(['ok' => false, 'message' => 'Match not found.'], 404);
        }

        return response()->json(['ok' => true, 'state' => $this->ttt->payload($match, Auth::id())]);
    }

    /** The player clicked a cell. */
    public function move(Request $request, $id)
    {
        $request->validate(['cell' => 'required|integer|min:0|max:48']);

        $out = $this->ttt->move(Auth::user(), (int) $id, (int) $request->input('cell'));

        return $this->respond($out);
    }

    /** The player pressed Leave. */
    public function leave($id)
    {
        $match = $this->ttt->leave(Auth::user(), (int) $id);
        if (! $match) {
            return response()->json(['ok' => false, 'message' => 'Match not found.'], 404);
        }

        return response()->json(['ok' => true, 'state' => $this->ttt->payload($match, Auth::id())]);
    }

    /**
     * One shape for every answer: {ok, state, ai_cell} or {ok:false, message}.
     */
    protected function respond(array $out)
    {
        if ($out['error']) {
            $body = ['ok' => false, 'message' => $out['error']];

            // Not enough points to join: the page shows an "add points" notice.
            if (! empty($out['low_balance'])) {
                $body['low_balance'] = $out['low_balance'];
            }

            // On a rejected move still hand back the real board so the page can resync.
            if (! empty($out['match'])) {
                $body['state'] = $this->ttt->payload($out['match'], Auth::id());
            }

            return response()->json($body, 422);
        }

        return response()->json([
            'ok' => true,
            'state' => $this->ttt->payload($out['match'], Auth::id()),
            'ai_cell' => isset($out['ai_cell']) ? $out['ai_cell'] : null,
        ]);
    }
}
