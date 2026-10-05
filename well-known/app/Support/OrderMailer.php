<?php

namespace App\Support;

use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Same idea as App\Support\DonationMailer — one place that sends order
 * emails the same way from everywhere that triggers them (checkout,
 * admin payment verify/reject, admin status updates).
 */
class OrderMailer
{
    public static function send(Order $order, $mailableClass)
    {
        if (empty($order->ship_email)) {
            // No email was collected for this order — nothing to send to.
            return;
        }

        try {
            Mail::to($order->ship_email)->send(new $mailableClass($order));
        } catch (\Exception $e) {
            // A broken mail server should never break checkout or admin
            // actions — the order/payment itself has already gone through.
            Log::warning('Order email failed to send: ' . $e->getMessage());
        }
    }
}
