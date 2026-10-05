{{--
    Shared "Send order via WhatsApp" button + helper text — included from
    both checkout/thanks.blade.php (manual/bKash-style payment flow) and
    checkout/confirmation.blade.php (direct order flow + "View" from
    Order History). Expects $order and $setting in scope (both already
    passed by CheckoutController@thanks / @confirmation / @manual).
--}}
@if(!empty($setting->whatsapp_order_number ?? null))
    @php
        $waLines = ["Hi, I've placed order #" . $order->order_number . ':'];
        foreach ($order->items as $wi) {
            $waLines[] = '- ' . $wi->product_title . ' x' . $wi->quantity . ' (' . $order->currency . number_format($wi->unit_price, 2) . ')';
        }
        $waLines[] = 'Total: ' . $order->currency . number_format($order->total, 2);
        $waLines[] = 'Please confirm my order. Thank you!';
        $waNumber = preg_replace('/\D/', '', $setting->whatsapp_order_number);
        $waText = urlencode(implode("\n", $waLines));
    @endphp
    <a href="https://wa.me/{{ $waNumber }}?text={{ $waText }}" target="_blank" id="pos-whatsapp-order-link" class="btn rounded-pill px-4" style="background:#25D366;color:#fff;">
        <i class="fab fa-whatsapp"></i> {{ __('Send order via WhatsApp') }}
    </a>
    <div class="small text-muted mt-2 w-100">
        {{ __('Click the WhatsApp Order button above to help us process your order faster.') }}
    </div>
@endif
