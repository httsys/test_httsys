@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Order #{{ $order->order_number }}</h1>

    <a href="{{ route('orders.admin.index') }}" class="btn btn-primary btn-back mb-3">Back to Orders</a>

    @if ($message = Session::get('order_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Customer &amp; Shipping</h6></div>
                <div class="card-body">
                    <p class="mb-1"><strong>Customer:</strong> {{ $order->user->name ?? '—' }}</p>
                    <p class="mb-1"><strong>Type:</strong> {{ $order->order_type === 'pickup' ? 'Pick Up' : 'Delivery' }}</p>
                    <p class="mb-1"><strong>Name:</strong> {{ $order->ship_name }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $order->ship_phone }}</p>
                    @if($order->ship_email)<p class="mb-1"><strong>Email:</strong> {{ $order->ship_email }}</p>@endif
                    <p class="mb-0"><strong>{{ $order->order_type === 'pickup' ? 'Pickup Location' : 'Address' }}:</strong> {{ $order->ship_address_line }}, {{ $order->ship_city }}, {{ $order->ship_state }}, {{ $order->ship_country }} @if($order->ship_postal_code), {{ $order->ship_postal_code }}@endif</p>
                    @if($order->coupon_code)
                        <p class="mb-0 mt-1"><strong>Coupon:</strong> <code>{{ $order->coupon_code }}</code> (-{{ $order->currency }}{{ number_format($order->discount, 2) }})</p>
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Payment</h6></div>
                <div class="card-body">
                    <p class="mb-1"><strong>Method:</strong> {{ $order->payment_method_label }}</p>
                    <p class="mb-1"><strong>Status:</strong>
                        @if ($order->payment_status === 'paid')
                            <span class="badge badge-success">Paid</span>
                        @else
                            <span class="badge badge-danger">Unpaid</span>
                        @endif
                    </p>
                    @if ($order->manual_reference)
                        <p class="mb-1"><strong>Reference submitted by buyer:</strong> {{ $order->manual_reference }}</p>
                    @endif

                    @if ($order->payment_method_id && $order->payment_status !== 'paid')
                        <form action="{{ route('orders.admin.verify', $order->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">Mark Paid</button>
                        </form>
                        @if ($order->manual_reference)
                            <form action="{{ route('orders.admin.reject', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Reject Reference</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Order Status</h6></div>
                <div class="card-body">
                    <form action="{{ route('orders.admin.status', $order->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <select name="status" class="form-control">
                                @foreach(['pending', 'confirmed', 'on_the_way', 'delivered', 'cancelled'] as $s)
                                    <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Items</h6></div>
                <div class="card-body">
                    @foreach ($order->items as $item)
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <div>
                                {{ $item->product_title }}
                                @if($item->variant_summary)<br><small class="text-muted">{{ $item->variant_summary }}</small>@endif
                            </div>
                            <div class="text-right">
                                {{ $order->currency }}{{ number_format($item->unit_price, 2) }} x {{ $item->quantity }}
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-between mt-3"><span>Subtotal</span><span>{{ $order->currency }}{{ number_format($order->subtotal, 2) }}</span></div>
                    <div class="d-flex justify-content-between"><span>Tax</span><span>{{ $order->currency }}{{ number_format($order->tax, 2) }}</span></div>
                    <div class="d-flex justify-content-between"><span>Shipping Charge</span><span>{{ $order->currency }}{{ number_format($order->shipping_charge, 2) }}</span></div>
                    <div class="d-flex justify-content-between"><span>Discount</span><span>{{ $order->currency }}{{ number_format($order->discount, 2) }}</span></div>
                    <div class="d-flex justify-content-between font-weight-bold" style="font-size:18px; border-top:1px solid #eee; padding-top:10px; margin-top:6px;"><span>Total</span><span>{{ $order->currency }}{{ number_format($order->total, 2) }}</span></div>
                </div>
            </div>
        </div>
    </div>

</div>

@stop
