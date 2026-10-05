<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('আপনার অর্ডার গ্রহণ করা হয়েছে / Your Order Was Received (#' . $this->order->order_number . ')')
            ->view('emails.order-placed');
    }
}
