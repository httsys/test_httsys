<?php

namespace App\Http\Controllers;

use App\Models\OrderReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Admin/author review screen for customer-submitted return requests
 * (order_returns — see resources/views/checkout/confirmation.blade.php's
 * "Request Return" modal for where these come from). Accepting or
 * rejecting here only updates the request's status and is shown back to
 * the customer on their "Return Orders" profile tab — it does not by
 * itself move any money or touch stock; the store still arranges the
 * actual pickup/refund outside the system once a request is accepted.
 */
class AdminOrderReturnController extends Controller
{
    public function index(Request $request)
    {
        $returns = OrderReturn::with(['order', 'user', 'items.orderItem'])
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->orderBy('id', 'desc')
            ->paginate(20)
            ->withQueryString();

        return view('admin.order-returns.index', compact('returns'));
    }

    public function accept(Request $request, OrderReturn $orderReturn)
    {
        $request->validate(['admin_note' => 'nullable|string|max:2000']);

        $orderReturn->update([
            'status' => 'accepted',
            'admin_note' => $request->admin_note,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('order_success', 'Return request #' . $orderReturn->id . ' accepted.');
    }

    public function reject(Request $request, OrderReturn $orderReturn)
    {
        $request->validate(['admin_note' => 'required|string|max:2000']);

        $orderReturn->update([
            'status' => 'rejected',
            'admin_note' => $request->admin_note,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('order_success', 'Return request #' . $orderReturn->id . ' rejected.');
    }
}
