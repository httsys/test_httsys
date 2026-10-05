<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPaymentVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('আপনার পেমেন্ট নিশ্চিত হয়েছে / Your Payment Was Confirmed (#' . $this->order->order_number . ')')
            ->view('emails.order-payment-verified');
    }
}
