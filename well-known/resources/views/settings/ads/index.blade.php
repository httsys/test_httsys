@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ad Placements</h1>
    <p class="mb-4 text-muted">Paste any Google AdSense or third-party ad code below, turn a placement on, and it will show up automatically at that spot across the site. Leave a placement off to hide it.</p>

    @if (session('status'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ session('status') }}</strong>
        </div>
    @endif

    @include('includes.form-errors')

    <form action="{{ route('ad-zone.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            @foreach ($zones as $zone)
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $zone->name }}</h6>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="active_{{ $zone->id }}" name="zones[{{ $zone->id }}][is_active]" value="1" {{ $zone->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="active_{{ $zone->id }}">{{ $zone->is_active ? 'On' : 'Off' }}</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-2">Placement key: <code>{{ $zone->key }}</code></p>
                            <textarea name="zones[{{ $zone->id }}][code]" class="form-control" rows="6" style="font-family: monospace; font-size: 13px;" placeholder="Paste AdSense or any ad network's HTML/JS snippet here...">{{ old("zones.{$zone->id}.code", $zone->code) }}</textarea>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary btn-lg">Save All Ad Placements</button>
    </form>

</div>
<!-- /.container-fluid -->

@endsection
