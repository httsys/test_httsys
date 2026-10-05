<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPaymentRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('আপনার পেমেন্ট যাচাই করা যায়নি / We Could Not Verify Your Payment (#' . $this->order->order_number . ')')
            ->view('emails.order-payment-rejected');
    }
}
