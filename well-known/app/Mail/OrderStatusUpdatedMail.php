<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    protected $subjects = [
        'confirmed' => 'আপনার অর্ডার কনফার্ম হয়েছে / Your Order Was Confirmed',
        'on_the_way' => 'আপনার অর্ডার পথে আছে / Your Order Is On The Way',
        'delivered' => 'আপনার অর্ডার ডেলিভার হয়েছে / Your Order Was Delivered',
        'cancelled' => 'আপনার অর্ডার বাতিল হয়েছে / Your Order Was Cancelled',
    ];

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        $subject = $this->subjects[$this->order->status] ?? 'Your Order Status Was Updated';

        return $this->subject($subject . ' (#' . $this->order->order_number . ')')
            ->view('emails.order-status-updated');
    }
}
