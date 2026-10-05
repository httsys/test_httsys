@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Wallet Service Fees</h1>
            <p class="text-muted mb-0">Fixed fee plus a percentage, charged on the amount before it pays out.</p>
        </div>
        <a href="{{ route('wallet.admin.index') }}" class="btn btn-sm btn-secondary">Back to wallets</a>
    </div>

    @if ($message = Session::get('wallet_admin_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <form method="POST" action="{{ route('wallet.admin.fees.update') }}">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Fixed fee (৳)</th>
                                <th>Percentage fee (%)</th>
                                <th>Example on ৳1,000</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ([
                                'currency_exchange' => 'Currency Exchange',
                                'marketplace' => 'Product Marketplace',
                                'auction' => 'Auctions',
                            ] as $key => $label)
                                @php $fee = $fees[$key]; @endphp
                                <tr>
                                    <td>{{ $label }}</td>
                                    <td style="max-width:150px;">
                                        <input type="number" step="0.01" min="0" class="form-control"
                                               name="fees[{{ $key }}][fixed_fee]" value="{{ old('fees.' . $key . '.fixed_fee', $fee->fixed_fee) }}">
                                    </td>
                                    <td style="max-width:150px;">
                                        <input type="number" step="0.01" min="0" max="100" class="form-control"
                                               name="fees[{{ $key }}][percent_fee]" value="{{ old('fees.' . $key . '.percent_fee', $fee->percent_fee) }}">
                                    </td>
                                    <td class="text-muted">
                                        ৳{{ number_format($fee->fixed_fee + (1000 * $fee->percent_fee / 100), 2) }} fee
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary">Save Fees</button>
            </div>
        </div>
    </form>

</div>
@stop
