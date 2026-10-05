@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Wallets</h1>
    <p class="text-muted">Every user with a wallet, highest balance first.</p>

    <div class="mb-3">
        <a href="{{ route('wallet.admin.escrow.index') }}" class="btn btn-sm btn-primary">Escrow Holds</a>
        <a href="{{ route('wallet.admin.withdrawals.index') }}" class="btn btn-sm btn-primary">Withdrawal Requests</a>
        @haspermission('wallet.fees.manage')
            <a href="{{ route('wallet.admin.fees.edit') }}" class="btn btn-sm btn-secondary">Fee Settings</a>
        @endhaspermission
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $u)
                            <tr>
                                <td>{{ $u->name }}<br><small class="text-muted">{{ $u->email }}</small></td>
                                <td>৳{{ number_format($u->wallet->balance, 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2" class="text-center text-muted">No wallets yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {!! $users->render() !!}
            </div>
        </div>
    </div>

</div>
@stop
