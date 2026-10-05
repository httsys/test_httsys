<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;

/**
 * "POS Orders" admin screen — same `shop_orders` table as the normal
 * Orders screen (AdminOrderController), just filtered to order_type =
 * 'pos' so in-store sales and online orders each get their own list, as
 * shown in the reference design.
 */
class PosOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['items', 'user', 'servedBy'])
            ->where('order_type', 'pos')
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->filled('payment_method'), function ($q) use ($request) {
                $q->where('payment_method', $request->payment_method);
            })
            ->when($request->filled('date_from'), function ($q) use ($request) {
                $q->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->filled('date_to'), function ($q) use ($request) {
                $q->whereDate('created_at', '<=', $request->date_to);
            })
            ->orderBy('id', 'desc')
            ->paginate(25)
            ->withQueryString();

        return view('admin.pos.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_unless($order->order_type === 'pos', 404);

        return response()->json([
            'html' => view('admin.pos._receipt-content', [
                'order' => $order->load(['items', 'user', 'servedBy']),
                'setting' => Setting::first(),
            ])->render(),
        ]);
    }

    public function print(Order $order)
    {
        abort_unless($order->order_type === 'pos', 404);

        return view('admin.pos.receipt-print', [
            'order' => $order->load(['items', 'user', 'servedBy']),
            'setting' => Setting::first(),
        ]);
    }

    public function destroy(Order $order)
    {
        abort_unless($order->order_type === 'pos', 404);

        $order->items()->delete();
        $order->delete();

        return back()->with('order_success', 'POS order #' . $order->order_number . ' deleted.');
    }

    /**
     * Simple CSV export of the (optionally filtered) POS order list —
     * matches the "Export" button in the reference design.
     */
    public function export(Request $request)
    {
        $orders = Order::where('order_type', 'pos')
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->orderBy('id', 'desc')
            ->get();

        $filename = 'pos-orders-' . now()->format('Y-m-d-His') . '.csv';

        $callback = function () use ($orders) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Order ID', 'Customer', 'Amount', 'Payment Method', 'Date', 'Status']);

            foreach ($orders as $order) {
                fputcsv($handle, [
                    $order->order_number,
                    $order->ship_name,
                    number_format($order->total, 2),
                    $order->payment_method,
                    $order->created_at->format('h:i A, d-m-Y'),
                    ucfirst($order->status),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
