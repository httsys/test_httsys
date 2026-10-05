@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Currencies</h1>
            <p class="text-muted mb-0">What shows in the "Post a Currency Listing" dropdown.</p>
        </div>
        <a href="{{ route('currency.admin.index') }}" class="btn btn-sm btn-secondary">Back to listings</a>
    </div>

    @if ($message = Session::get('currency_admin_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add a currency</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('currency.admin.currencies.store') }}" class="form-inline">
                @csrf
                <input type="text" name="code" class="form-control mr-2 mb-2" placeholder="Code, e.g. EUR" style="width:120px;" maxlength="10" required>
                <input type="text" name="name" class="form-control mr-2 mb-2" placeholder="Name, e.g. Euro" style="width:200px;" required>
                <input type="number" name="sort_order" class="form-control mr-2 mb-2" placeholder="Order" style="width:100px;">
                <button type="submit" class="btn btn-primary mb-2">Add</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Shown in dropdown</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($currencies as $currency)
                        <tr>
                            <td>{{ $currency->code }}</td>
                            <td>{{ $currency->name }}</td>
                            <td>
                                @if ($currency->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Hidden</span>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('currency.admin.currencies.toggle', $currency->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm {{ $currency->is_active ? 'btn-outline-secondary' : 'btn-outline-success' }}">
                                        {{ $currency->is_active ? 'Hide' : 'Show' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('currency.admin.currencies.destroy', $currency->id) }}" class="d-inline" onsubmit="return confirm('Remove this currency from the list? Existing listings already using it are unaffected.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted">No currencies yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@stop
