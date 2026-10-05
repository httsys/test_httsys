@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Edit Fund</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('includes.form-errors')

            <form action="{{ route('funds.update', $fund->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <strong>Title</strong>
                    <input type="text" name="title" class="form-control" value="{{ $fund->title }}" required>
                </div>
                <div class="form-group">
                    <strong>Short Description</strong>
                    <input type="text" name="short_description" class="form-control" value="{{ $fund->short_description }}">
                </div>
                <div class="form-group">
                    <strong>Full Description</strong>
                    <textarea name="description" class="form-control" rows="4">{{ $fund->description }}</textarea>
                </div>
                <div class="form-group">
                    <strong>Photo</strong><br>
                    @if ($fund->photo)
                        <img src="/public/images/media/{{ $fund->photo->file }}" width="80" class="mb-2 d-block">
                    @endif
                    <input type="file" name="photo_id" class="form-control-file">
                </div>
                <div class="form-group">
                    <strong>Target Amount (৳, optional)</strong>
                    <input type="number" name="target_amount" class="form-control" min="0" step="0.01" value="{{ $fund->target_amount }}">
                </div>
                <div class="form-group">
                    <strong>Collected so far (৳)</strong>
                    <input type="text" class="form-control" value="{{ number_format($fund->collected_amount, 2) }}" disabled>
                    <small class="text-muted">Updates automatically as donations complete.</small>
                </div>
                <div class="form-group">
                    <label><input type="checkbox" name="is_active" value="1" {{ $fund->is_active ? 'checked' : '' }}> Active (visible on donation page)</label>
                </div>

                <a href="{{ route('funds.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

</div>

@stop
