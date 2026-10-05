@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">POS Orders</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">In-Store Sales</h6>
            <div>
                <div class="dropdown d-inline-block">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="posFilterDropdown" data-toggle="dropdown">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <div class="dropdown-menu dropdown-menu-right p-3" style="min-width:260px;">
                        <form method="GET">
                            <div class="form-group mb-2">
                                <label class="small mb-1">Status</label>
                                <select name="status" class="form-control form-control-sm">
                                    <option value="">All</option>
                                    @foreach(['pending', 'confirmed', 'on_the_way', 'delivered', 'cancelled'] as $s)
                                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="small mb-1">Payment Method</label>
                                <select name="payment_method" class="form-control form-control-sm">
                                    <option value="">All</option>
                                    @foreach(['cash', 'card', 'mfs', 'other'] as $m)
                                        <option value="{{ $m }}" {{ request('payment_method') == $m ? 'selected' : '' }}>{{ ucfirst($m) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="small mb-1">From</label>
                                <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control form-control-sm">
                            </div>
                            <div class="form-group mb-2">
                                <label class="small mb-1">To</label>
                                <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control form-control-sm">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm btn-block">Apply</button>
                            <a href="{{ route('pos-orders.index') }}" class="btn btn-link btn-sm btn-block">Clear</a>
                        </form>
                    </div>
                </div>
                <a href="{{ route('pos-orders.export', request()->query()) }}" class="btn btn-outline-success btn-sm">
                    <i class="fas fa-file-export"></i> Export
                </a>
            </div>
        </div>
        <div class="card-body">

            @if ($message = Session::get('order_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>#{{ $order->order_number }}</td>
                                <td>{{ $order->ship_name }}</td>
                                <td>{{ config('shop.currency_symbol') }}{{ number_format($order->total, 2) }}</td>
                                <td>{{ ucfirst($order->payment_method) }}</td>
                                <td>{{ $order->created_at->format('h:i A, d-m-Y') }}</td>
                                <td>
                                    @php
                                        $badge = [
                                            'pending' => 'warning', 'confirmed' => 'info', 'on_the_way' => 'primary',
                                            'delivered' => 'success', 'cancelled' => 'danger',
                                        ][$order->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge badge-{{ $badge }}">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('pos-orders.print', $order->id) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="View / Print">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('pos-orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this POS order? This cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted">No POS orders yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $orders->appends(request()->query())->render() !!}
            </div>

        </div>
    </div>

</div>

@endsection
