@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Donation Funds</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Funds (what donors can give to)</h6>
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-lg-6">
                    <a href="{{ route('donations.admin.index') }}" class="btn btn-primary btn-back">View All Donations</a>
                </div>
                <div class="col-lg-6 text-right">
                    @if (!empty($langs))
                        <select name="language" class="form-control language-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            @foreach ($langs as $lang)
                                <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>

            @if ($message = Session::get('fund_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Title</th>
                                <th>Collected</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($funds as $fund)
                                <tr>
                                    <td><img src="{{ $fund->photo ? '/public/images/media/' . $fund->photo->file : '/public/img/200x200.png' }}" width="40"></td>
                                    <td>{{ $fund->title }}</td>
                                    <td>
                                        ৳{{ number_format($fund->collected_amount) }}
                                        @if ($fund->target_amount) / ৳{{ number_format($fund->target_amount) }} @endif
                                    </td>
                                    <td>{!! $fund->is_active ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-secondary">No</span>' !!}</td>
                                    <td>
                                        <a href="{{ route('funds.edit', $fund->id) }}">Edit</a>
                                        &nbsp;|&nbsp;
                                        <form action="{{ route('funds.destroy', $fund->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this fund?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center text-muted">No funds yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $funds->render() !!}
                </div>

                <div class="col-md-5">
                    @include('includes.form-errors')

                    <form action="{{ route('funds.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="language_id" value="{{ $lang_id }}">
                        <div class="form-group">
                            <strong>Title</strong>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <strong>Short Description</strong>
                            <input type="text" name="short_description" class="form-control" placeholder="Shown on the donation form">
                        </div>
                        <div class="form-group">
                            <strong>Full Description</strong>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <strong>Photo</strong>
                            <input type="file" name="photo_id" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <strong>Target Amount (৳, optional)</strong>
                            <input type="number" name="target_amount" class="form-control" min="0" step="0.01">
                        </div>
                        <div class="form-group">
                            <label><input type="checkbox" name="is_active" value="1" checked> Active (visible on donation page)</label>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

@stop
