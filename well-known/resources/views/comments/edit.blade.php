@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Edit Comment</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Comment</h6>
        </div>
        <div class="card-body">

            <a href="{{ route('comments.index') }}" class="btn btn-primary btn-back mb-3">Back to Comments</a>

            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Post</strong>
                            <p>{{ $comment->post->title ?? '(deleted post)' }}</p>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Author</strong>
                            <p>{{ $comment->author }} ({{ $comment->email }})</p>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Comment</strong>
                            <textarea name="body" class="form-control" rows="6">{{ $comment->body }}</textarea>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Visible on site</strong>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ $comment->is_active ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">{{ $comment->is_active ? 'On' : 'Off' }}</label>
                            </div>
                            <p class="text-muted small mb-0">অফ করলে এই কমেন্টটা ওয়েবসাইটে আর দেখা যাবে না, কিন্তু ডিলিট হবে না।</p>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>

@stop
