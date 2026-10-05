@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">All Comments</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Comments</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                @if ($message = Session::get('comment_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif

                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Post</th>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($comments as $comment)
                            <tr>
                                <td data-label="Post">
                                    @if($comment->post)
                                        <a href="{{ url('/post/' . rawurlencode($comment->post->slug)) }}" target="_blank">{{ \Illuminate\Support\Str::limit($comment->post->title, 40) }}</a>
                                    @else
                                        <span class="text-muted">(deleted post)</span>
                                    @endif
                                </td>
                                <td data-label="Author">
                                    {{ $comment->author }}
                                    <br><small class="text-muted">{{ $comment->email }}</small>
                                </td>
                                <td data-label="Comment">{{ \Illuminate\Support\Str::limit($comment->body, 80) }}</td>
                                <td data-label="Status">
                                    @if($comment->is_active)
                                        <span class="badge badge-success">Visible</span>
                                    @else
                                        <span class="badge badge-secondary">Hidden</span>
                                    @endif
                                </td>
                                <td data-label="Date">{{ $comment->created_at->format('Y-m-d H:i') }}</td>
                                <td data-label="Actions">
                                    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No comments yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {!! $comments->render() !!}

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@stop
