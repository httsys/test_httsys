@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Orders</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Orders</h6>
        </div>
        <div class="card-body">

            @if ($message = Session::get('order_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <form method="GET" class="form-inline mb-3">
                <select name="status" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    @foreach(['pending', 'confirmed', 'on_the_way', 'delivered', 'cancelled'] as $s)
                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                    @endforeach
                </select>
                <select name="payment_status" class="form-control form-control-sm mr-2" onchange="this.form.submit()">
                    <option value="">All Payment Statuses</option>
                    <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                </select>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Method</th>
                            <th>Payment</th>
                            <th>Reference (manual)</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td><a href="{{ route('orders.admin.show', $order->id) }}">#{{ $order->order_number }}</a></td>
                                <td>
                                    {{ $order->ship_name }}<br>
                                    <small class="text-muted">{{ $order->ship_phone }}</small>
                                </td>
                                <td>{{ $order->currency }}{{ number_format($order->total, 2) }}</td>
                                <td>{{ $order->payment_method_label }}</td>
                                <td>
                                    @if ($order->payment_status === 'paid')
                                        <span class="badge badge-success">Paid</span>
                                    @else
                                        <span class="badge badge-danger">Unpaid</span>
                                    @endif
                                </td>
                                <td>{{ $order->manual_reference ?: '—' }}</td>
                                <td>
                                    <form action="{{ route('orders.admin.status', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <select name="status" class="form-control form-control-sm" onchange="this.form.submit()" style="min-width:130px;">
                                            @foreach(['pending', 'confirmed', 'on_the_way', 'delivered', 'cancelled'] as $s)
                                                <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    @if ($order->payment_method_id && $order->payment_status !== 'paid')
                                        <form action="{{ route('orders.admin.verify', $order->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-success p-0">Mark Paid</button>
                                        </form>
                                        @if ($order->manual_reference)
                                            &nbsp;|&nbsp;
                                            <form action="{{ route('orders.admin.reject', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-link text-danger p-0">Reject Reference</button>
                                            </form>
                                        @endif
                                    @endif
                                    &nbsp;|&nbsp;
                                    <a href="{{ route('orders.admin.show', $order->id) }}">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center text-muted">No orders yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $orders->render() !!}
            </div>

        </div>
    </div>

</div>

@stop
