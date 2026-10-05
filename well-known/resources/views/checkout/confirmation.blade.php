@extends('layouts.front')

@section('title') Order Confirmed @endsection

@section('content')
<style>
    .oc-wrap { padding: 20px 0 40px; overflow-x: hidden; }
    .oc-tracker { display: flex; align-items: flex-start; justify-content: center; margin: 30px 0 40px; }
.oc-step { display: flex; flex-direction: column; align-items: center; width: 80px; flex-shrink: 0; }
.oc-step .dot { width: 30px; height: 30px; border-radius: 50%; background: #e2e6ee; color: #888; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0; font-size: 12px; }
.oc-step.done .dot { background: #12b76a; color: #fff; }
.oc-step .label { margin-top: 8px; font-size: 11px; color: #888; text-align: center; }
.oc-line { flex: 1 1 auto; height: 2px; background: #e2e6ee; margin-top: 15px; min-width: 10px; max-width: 60px; }
@media (max-width: 480px) {
    .oc-step { width: 56px; }
    .oc-step .dot { width: 24px; height: 24px; font-size: 10px; }
    .oc-step .label { font-size: 9px; }
    .oc-line { max-width: 18px; }
}

    .oc-card { background: #fff; border: 1.5px solid #d7dbe3; border-radius: 14px; box-shadow: 0 2px 14px rgba(20,20,43,0.08); padding: 24px 26px; margin-bottom: 20px; }
    .oc-card h6 { font-size: 15px; font-weight: 700; color: #111; margin: 0 0 16px 0; display: flex; align-items: center; gap: 8px; }
    .oc-card h6 .oc-card-icon { width: 26px; height: 26px; border-radius: 8px; background: #eaf4ff; color: #0097ff; display: inline-flex; align-items: center; justify-content: center; font-size: 14px; }
    .oc-row { display: flex; justify-content: space-between; align-items: center; padding: 9px 0; border-bottom: 1px solid #f4f4f7; font-size: 14px; }
    .oc-row:last-child { border-bottom: none; }
    .oc-row span:first-child { color: #888; }
    .oc-row span:last-child, .oc-row strong { color: #222; font-weight: 600; }
    .oc-addr-line { color: #444; font-size: 14px; line-height: 22px; margin: 0 0 6px 0; }
    .oc-addr-line strong { color: #111; }

    .oc-item { display: flex; gap: 14px; align-items: center; padding: 12px 0; border-bottom: 1px solid #f4f4f7; }
    .oc-item:first-of-type { padding-top: 0; }
    .oc-item img { width: 56px; height: 56px; object-fit: cover; border-radius: 10px; background: #f7f7f7; }
    .oc-item .name { font-weight: 600; color: #222; font-size: 14px; }

    .oc-summary-row { display: flex; justify-content: space-between; padding: 6px 0; font-size: 14px; color: #555; }
    .oc-summary-total { display: flex; justify-content: space-between; font-weight: 700; font-size: 18px; border-top: 1px solid #eee; padding-top: 12px; margin-top: 8px; color: #111; }

    .badge-status { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
    .badge-pending { background: #fef3d7; color: #b98900; }
    .badge-unpaid { background: #fde2e2; color: #c0392b; }
    .badge-paid { background: #d7f5e6; color: #12894e; }
    .btn-theme { background: #0097ff; border-color: #0097ff; color: #fff; }
    .btn-theme:hover, .btn-theme:focus { background: #0080e0; border-color: #0080e0; color: #fff; }
    .btn-theme-outline { background: #fff; border: 1.5px solid #0097ff; color: #0097ff; }
.btn-theme-outline:hover, .btn-theme-outline:focus { background: #eaf4ff; color: #0097ff; }
</style>
<div class="breadcrumb-area">
    <div class="container">
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">Home</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">Order Confirmed</li>
        </ul>
        <h1 class="breadcrumb-title">Order Confirmed</h1>
        <ul class="shape-group-code">
            <li class="shape shape-1"><img src="/public/img/bubble-9.png" alt="circle"></li>
            <li class="shape shape-2"><img src="/public/img/bubble-17.png" alt="circle"></li>
            <li class="shape shape-3"><img src="/public/img/line-4.png" alt="circle"></li>
        </ul>
    </div>
</div>


<div class="container oc-wrap">
    <div class="text-center">
        <h3>Thank You</h3>
        <p class="text-muted">Your Order status is as follows</p>
        <p>Order ID: <strong>#{{ $order->order_number }}</strong></p>
    </div>

    @if ($order->payment_method_id && $order->payment_status === 'unpaid')
        @if ($order->manual_reference)
            <div class="alert alert-warning text-center" role="alert">
                We've received your payment reference (<strong>{{ $order->manual_reference }}</strong>) and it's being verified. We'll update your order once it's confirmed.
            </div>
        @else
            <div class="alert alert-warning text-center" role="alert">
                This order is waiting on payment.
                <a href="{{ route('checkout.manual', $order->id) }}">Complete your {{ $order->payment_method_label }} payment</a> to confirm it.
            </div>
        @endif
    @endif

    <div class="oc-tracker">
        @php $stepIndex = $order->status_step_index; @endphp
        @foreach(['Order Pending', 'Order Confirmed', 'Order On The Way', 'Order Delivered'] as $i => $label)
            <div class="oc-step {{ $order->status !== 'cancelled' && $i <= $stepIndex ? 'done' : '' }}">
                <div class="dot">{{ $order->status !== 'cancelled' && $i <= $stepIndex ? '✓' : $i + 1 }}</div>
                <div class="label">{{ $label }}</div>
            </div>
            @if(!$loop->last)
                <div class="oc-line {{ $order->status !== 'cancelled' && $i < $stepIndex ? 'done' : '' }}"></div>
            @endif
        @endforeach
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="oc-card">
                <h6><span class="oc-card-icon">📦</span> Order Details</h6>
                <div class="oc-row"><span>Order ID</span><strong>#{{ $order->order_number }}</strong></div>
                <div class="oc-row"><span>Order Date</span><span>{{ $order->created_at->format('h:i A, d-m-Y') }}</span></div>
                <div class="oc-row"><span>Order Type</span><span>{{ ucfirst($order->order_type) }}</span></div>
                <div class="oc-row"><span>Order Status</span><span class="badge-status badge-pending">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span></div>
                <div class="oc-row"><span>Payment Status</span><span class="badge-status {{ $order->payment_status === 'paid' ? 'badge-paid' : 'badge-unpaid' }}">{{ ucfirst($order->payment_status) }}</span></div>
                <div class="oc-row"><span>Payment Method</span><span>{{ $order->payment_method_label }}</span></div>
            </div>

            <div class="oc-card">
                <h6><span class="oc-card-icon">📍</span> Shipping Address</h6>
                <p class="oc-addr-line"><strong>Name:</strong> {{ $order->ship_name }}</p>
                <p class="oc-addr-line"><strong>Phone:</strong> {{ $order->ship_phone }}</p>
                @if($order->ship_email)<p class="oc-addr-line"><strong>Email:</strong> {{ $order->ship_email }}</p>@endif
                <p class="oc-addr-line mb-0"><strong>Address:</strong> {{ $order->ship_address_line }}, {{ $order->ship_city }}, {{ $order->ship_state }}, {{ $order->ship_country }} @if($order->ship_postal_code), {{ $order->ship_postal_code }}@endif</p>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="oc-card">
                <h6><span class="oc-card-icon">🛒</span> Order Summary</h6>
                @foreach($order->items as $item)
                    <div class="oc-item">
                        <img src="{{ $item->product_image ? '/public/images/media/' . $item->product_image : '/public/img/200x200.png' }}" alt="{{ $item->product_title }}">
                        <div class="flex-grow-1">
                            <div class="name">{{ $item->product_title }}</div>
                            @if($item->variant_summary)<div class="text-muted small">{{ $item->variant_summary }}</div>@endif
                            @if($item->product && $item->product->isDigital())
                                @if($order->payment_status === 'paid')
                                    @php $downloadUrl = $item->product->digitalFile ? '/public/images/media/' . $item->product->digitalFile->file : $item->product->digital_link; @endphp
                                    @if($downloadUrl)
                                        <div class="mt-1">
                                            <a href="{{ $downloadUrl }}" target="_blank" class="btn btn-sm btn-theme rounded-pill px-3">⬇ Download</a>
                                        </div>
                                    @endif
                                @else
                                    <div class="text-muted small mt-1">Download unlocks once payment is confirmed.</div>
                                @endif
                            @endif
                        </div>
                        <div class="text-right">
                            {{ $order->currency }}{{ number_format($item->unit_price, 2) }}<br>
                            <span class="text-muted small">Quantity: {{ $item->quantity }}</span>
                        </div>
                    </div>
                @endforeach

                <div class="oc-summary-row"><span>Subtotal</span><span>{{ $order->currency }}{{ number_format($order->subtotal, 2) }}</span></div>
                <div class="oc-summary-row"><span>Tax Fee</span><span>{{ $order->currency }}{{ number_format($order->tax, 2) }}</span></div>
                <div class="oc-summary-row"><span>Shipping Charge</span><span>{{ $order->currency }}{{ number_format($order->shipping_charge, 2) }}</span></div>
                <div class="oc-summary-row"><span>Discount</span><span>{{ $order->currency }}{{ number_format($order->discount, 2) }}</span></div>
                <div class="oc-summary-total"><span>Total</span><span>{{ $order->currency }}{{ number_format($order->total, 2) }}</span></div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('checkout.receipt', $order->id) }}" target="_blank" class="btn btn-theme rounded-pill px-4">⬇ Download Receipt</a>

        @if($order->order_type !== 'pos' && $order->status === 'pending')
            <form action="{{ route('checkout.cancel', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Cancel this order?');">
                @csrf
                <button type="submit" class="btn btn-outline-danger rounded-pill px-4">Cancel Order</button>
            </form>
        @endif

        @if(!empty($setting->whatsapp_order_number ?? null))
            @include('checkout._whatsapp-order-button', ['order' => $order, 'setting' => $setting])

            @if($justPlaced ?? false)
                <script>
                    // Auto-opens the WhatsApp chat the moment this page
                    // loads right after placing the order — the browser
                    // still requires a human to press Send inside
                    // WhatsApp itself (no free method can skip that), but
                    // this removes the "find and click the button" step.
                    // Wrapped in try/catch since some browsers' popup
                    // blockers can throw rather than just silently block;
                    // either way the button above still works manually.
                    (function () {
                        try {
                            window.open(document.getElementById('pos-whatsapp-order-link').href, '_blank');
                        } catch (e) {}
                    })();
                </script>
            @endif
        @endif

        @if($order->status === 'delivered')
            <button type="button" class="btn btn-theme-outline rounded-pill px-4" data-toggle="modal" data-target="#requestReturnModal">Request Return</button>
        @endif

        <a href="{{ route('shop.index') }}" class="btn btn-theme-outline rounded-pill px-4">Continue Shopping</a>
    </div>

    @if($order->status === 'delivered')
    <style>
        /* This theme's sticky header/ticker uses a very high z-index
           (see public/css/front/venor.css) that otherwise sits on top of
           Bootstrap's default modal (z-index 1050) and covers its top
           half — bump these two comfortably above it. */
        #requestReturnModal { z-index: 100000 !important; }
        .modal-backdrop { z-index: 99990 !important; }
    </style>
    <div class="modal fade" id="requestReturnModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('checkout.return.request', $order->id) }}" method="POST" onsubmit="return document.querySelectorAll('#requestReturnModal input[type=checkbox]:checked').length > 0 || alert('Select at least one item to return.') && false;">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Request a Return</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted small">Choose the item(s) and quantity you'd like to return.</p>
                        @foreach($order->items as $ri)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="items[{{ $loop->index }}][order_item_id]" value="{{ $ri->id }}" id="ret-item-{{ $ri->id }}" onchange="document.getElementById('ret-qty-{{ $ri->id }}').disabled = !this.checked;">
                                <label class="form-check-label" for="ret-item-{{ $ri->id }}">{{ $ri->product_title }} (ordered: {{ $ri->quantity }})</label>
                                <input type="number" name="items[{{ $loop->index }}][quantity]" id="ret-qty-{{ $ri->id }}" min="1" max="{{ $ri->quantity }}" value="1" class="form-control form-control-sm mt-1" style="width:100px;" disabled>
                            </div>
                        @endforeach
                        <div class="form-group mt-3">
                            <label>Reason</label>
                            <input type="text" name="reason" class="form-control" required placeholder="e.g. Wrong size, damaged, changed my mind">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-theme">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
