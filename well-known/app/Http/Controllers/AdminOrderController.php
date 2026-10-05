<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['items', 'paymentMethod', 'user'])
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->when($request->filled('payment_status'), function ($q) use ($request) {
                $q->where('payment_status', $request->payment_status);
            })
            ->orderBy('id', 'desc')
            ->paginate(25)
            ->withQueryString();

        return view('shop.orders.admin-index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items', 'paymentMethod', 'user', 'address']);

        return view('shop.orders.admin-show', compact('order'));
    }

    /**
     * Admin confirms they've checked a manual-payment reference (bKash/
     * Nagad SMS, bank statement, etc) against what the buyer submitted.
     */
    public function verifyPayment(Order $order)
    {
        if ($order->payment_status !== 'paid') {
            $order->markPaid();
        }

        return back()->with('order_success', 'Payment marked as verified.');
    }

    /**
     * Reference didn't check out — clear it so the buyer can submit a
     * corrected one from their confirmation page.
     */
    public function rejectPayment(Order $order)
    {
        $order->update([
            'payment_status' => 'unpaid',
            'manual_reference' => null,
        ]);

        \App\Support\OrderMailer::send($order, \App\Mail\OrderPaymentRejectedMail::class);

        return back()->with('order_success', 'Payment reference rejected — the buyer can submit a new one.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,on_the_way,delivered,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        // Only these four are meaningful updates to email the buyer about
        // — "pending" is just the starting state, not something to notify
        // about, and wasChanged() keeps re-saving the same status from
        // sending a duplicate email.
        if ($order->wasChanged('status') && in_array($order->status, ['confirmed', 'on_the_way', 'delivered', 'cancelled'])) {
            \App\Support\OrderMailer::send($order, \App\Mail\OrderStatusUpdatedMail::class);
        }

        return back()->with('order_success', 'Order status updated.');
    }
}
