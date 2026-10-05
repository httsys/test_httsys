@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Mini Games &mdash; Play History</h1>
    <p class="text-muted">Every finished play (the ad was watched and the maths question answered correctly).</p>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card shadow-sm"><div class="card-body py-3">
                <div class="text-muted small">Total plays</div>
                <div class="h4 mb-0">{{ number_format($totals['plays']) }}</div>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm"><div class="card-body py-3">
                <div class="text-muted small">Wins</div>
                <div class="h4 mb-0">{{ number_format($totals['wins']) }}
                    <small class="text-muted">({{ $totals['plays'] > 0 ? round($totals['wins'] / $totals['plays'] * 100, 1) : 0 }}%)</small>
                </div>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm"><div class="card-body py-3">
                <div class="text-muted small">Points given out</div>
                <div class="h4 mb-0">{{ number_format($totals['points']) }}</div>
            </div></div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">

            <form method="GET" action="{{ route('game-plays.index') }}" class="form-inline mb-3">
                <input type="text" name="q" class="form-control mr-2 mb-2" placeholder="User name or email" value="{{ request('q') }}">
                <select name="game" class="form-control mr-2 mb-2">
                    <option value="">All games</option>
                    @foreach($games as $key => $game)
                        <option value="{{ $key }}" {{ request('game') === $key ? 'selected' : '' }}>{{ $game['name'] }}</option>
                    @endforeach
                </select>
                <select name="result" class="form-control mr-2 mb-2">
                    <option value="">Win &amp; lose</option>
                    <option value="win" {{ request('result') === 'win' ? 'selected' : '' }}>Wins only</option>
                    <option value="lose" {{ request('result') === 'lose' ? 'selected' : '' }}>Losses only</option>
                </select>
                <button type="submit" class="btn btn-primary mb-2">Filter</button>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>Game</th>
                            <th>Choice</th>
                            <th>Result</th>
                            <th>Points</th>
                            <th>Ad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plays as $play)
                            <tr>
                                <td>{{ optional($play->completed_at)->format('d M Y, h:i A') }}</td>
                                <td>
                                    {{ optional($play->user)->name ?: 'Deleted user' }}<br>
                                    <small class="text-muted">{{ optional($play->user)->email }}</small>
                                </td>
                                <td>{{ $games[$play->game_key]['name'] ?? $play->game_key }}</td>
                                <td>
                                    @if($play->game_key === 'up_down')
                                        {{ $play->direction === 'up' ? 'Higher' : 'Lower' }}, {{ $play->stake }} pts, {{ $play->trade_seconds }}s
                                    @elseif($play->game_key === 'three_numbers')
                                        Reels: {{ $play->outcome }}
                                    @else
                                        {{ $play->choice ? ucfirst($play->choice) : '—' }}
                                    @endif
                                </td>
                                <td>
                                    @if($play->is_win)
                                        <span class="badge badge-success">Win</span>
                                    @else
                                        <span class="badge badge-secondary">Lose</span>
                                    @endif
                                </td>
                                <td>{{ $play->netPoints() > 0 ? '+' . $play->netPoints() : $play->netPoints() }}</td>
                                <td>{{ optional($play->ad)->title ?: '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center text-muted">No plays yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {!! $plays->render() !!}
        </div>
    </div>

</div>

@stop
