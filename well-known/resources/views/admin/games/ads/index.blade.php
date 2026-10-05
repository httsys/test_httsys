@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Game Advertisements</h1>
            <p class="text-muted mb-0">Shown to a player after pressing Spin / Heads / Tails, before the result. One is picked at random for each play.</p>
        </div>
        <a href="{{ route('game-ads.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add Advertisement</a>
    </div>

    @if ($message = Session::get('game_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Link</th>
                            <th>Duration</th>
                            <th>Shown</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ads as $ad)
                            <tr>
                                <td>{{ $ad->title }}</td>
                                <td>{{ \App\Models\GameAd::$types[$ad->ad_type] ?? $ad->ad_type }}</td>
                                <td style="max-width:260px; word-break:break-all;">
                                    @if($ad->ad_type === 'code')
                                        <span class="text-muted">(code)</span>
                                    @else
                                        {{ $ad->link ?: $ad->image_url }}
                                    @endif
                                </td>
                                <td>{{ $ad->duration }}s</td>
                                <td>{{ $ad->shown_count }} / {{ $ad->max_show > 0 ? $ad->max_show : 'Unlimited' }}</td>
                                <td>
                                    @if(! $ad->is_active)
                                        <span class="badge badge-secondary">Off</span>
                                    @elseif($ad->hasReachedLimit())
                                        <span class="badge badge-warning">Limit reached</span>
                                    @else
                                        <span class="badge badge-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('game-ads.edit', $ad->id) }}">Edit</a>
                                    &nbsp;|&nbsp;
                                    <form action="{{ route('game-ads.destroy', $ad->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this advertisement?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted">No advertisements yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {!! $ads->render() !!}
        </div>
    </div>

</div>

@stop
