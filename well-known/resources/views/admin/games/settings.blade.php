@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Mini Games &mdash; Settings</h1>
    <p class="text-muted">Control how often users win, how many times they can play, and each game's own options. Changes apply to the very next play.</p>

    @if ($message = Session::get('game_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @include('includes.form-errors')

    @if ($availableAds == 0 && $anyGameNeedsAd)
        <div class="alert alert-warning">
            <strong>No advertisement is available.</strong>
            Games that have "Show advertisement" turned on cannot be started until at least one active ad (that has not reached its Maximum Show) exists.
            <a href="{{ route('game-ads.create') }}">Add an advertisement</a>
        </div>
    @endif

    <form action="{{ route('game-settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            @foreach ($games as $key => $game)
                @php $s = $settings[$key]; @endphp
                <div class="col-lg-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $game['name'] }}</h6>
                            <div class="form-check mb-0">
                                <input type="checkbox" class="form-check-input" id="active_{{ $key }}" name="settings[{{ $key }}][is_active]" value="1" {{ old('settings.' . $key . '.is_active', $s->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="active_{{ $key }}">Game is on</label>
                            </div>
                        </div>
                        <div class="card-body">

                            @if ($key === 'tic_tac_toe')
                                {{-- Tic Tac Toe has no advertisement page and no random win rate: the match decides. --}}
                                <input type="hidden" name="settings[{{ $key }}][win_percent]" value="{{ $s->win_percent }}">
                                <input type="hidden" name="settings[{{ $key }}][win_block]" value="{{ $s->blockSize() }}">
                            @else
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="showad_{{ $key }}" name="settings[{{ $key }}][show_ad]" value="1" {{ old('settings.' . $key . '.show_ad', $s->showsAd()) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="showad_{{ $key }}">Show advertisement before the result</label>
                                </div>
                                <small class="form-text text-muted">
                                    <strong>On:</strong> the player goes to the advertisement page (countdown + maths question) before seeing the result.
                                    <strong>Off:</strong> this game runs without the advertisement page and shows the result straight away.
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="win_{{ $key }}">User win rate</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">User wins</span></div>
                                    <input type="number" min="0" max="200" step="1" required class="form-control" id="win_{{ $key }}" name="settings[{{ $key }}][win_percent]" value="{{ old('settings.' . $key . '.win_percent', $s->win_percent) }}">
                                    <div class="input-group-append"><span class="input-group-text">out of</span></div>
                                    <input type="number" min="1" max="200" step="1" required class="form-control" name="settings[{{ $key }}][win_block]" value="{{ old('settings.' . $key . '.win_block', $s->blockSize()) }}">
                                    <div class="input-group-append"><span class="input-group-text">plays</span></div>
                                </div>
                                <small class="form-text text-muted">
                                    Example: <strong>30 out of 100</strong> = 30 wins and 70 losses in every 100 plays by one user.
                                    <strong>2 out of 5</strong> = 2 wins and 3 losses in every 5 plays. The order inside the group is random.
                                </small>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="limit_{{ $key }}">Plays allowed per hour (per user)</label>
                                <div class="input-group">
                                    <input type="number" min="0" step="1" required class="form-control" id="limit_{{ $key }}" name="settings[{{ $key }}][hourly_limit]" value="{{ old('settings.' . $key . '.hourly_limit', $s->hourly_limit) }}">
                                    <div class="input-group-append"><span class="input-group-text">per hour</span></div>
                                </div>
                                <small class="form-text text-muted">Counted over the last 60 minutes for each user. <strong>0 = unlimited.</strong></small>
                            </div>

                            @if (in_array($key, ['spin_wheel', 'flip_coin']))
                                <div class="form-group mb-0">
                                    <label for="points_{{ $key }}">Points added for a win</label>
                                    <div class="input-group">
                                        <input type="number" min="0" step="1" required class="form-control" id="points_{{ $key }}" name="settings[{{ $key }}][points_per_win]" value="{{ old('settings.' . $key . '.points_per_win', $s->points_per_win) }}">
                                        <div class="input-group-append"><span class="input-group-text">point(s)</span></div>
                                    </div>
                                </div>
                            @endif

                            @if ($key === 'tic_tac_toe')
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="points_{{ $key }}">Points for beating the computer</label>
                                        <div class="input-group">
                                            <input type="number" min="0" step="1" required class="form-control" id="points_{{ $key }}" name="settings[{{ $key }}][points_per_win]" value="{{ old('settings.' . $key . '.points_per_win', $s->points_per_win) }}">
                                            <div class="input-group-append"><span class="input-group-text">point(s)</span></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="fee_{{ $key }}">Points for winning an online match</label>
                                        <div class="input-group">
                                            <input type="number" min="0" max="100" step="1" class="form-control" id="fee_{{ $key }}" name="settings[{{ $key }}][online_fee_percent]" value="{{ old('settings.' . $key . '.online_fee_percent', $s->option('online_fee_percent', 10)) }}">
                                            <div class="input-group-append"><span class="input-group-text">% fee</span></div>
                                        </div>
                                    </div>
                                </div>
                                <small class="form-text text-muted" style="margin-top:-6px; margin-bottom:14px;">
                                    <strong>Online matches are played for points.</strong> The player who opens the room chooses how many points to play for and the friend must put in the same amount.
                                    The winner receives both players' points together <strong>minus this percent</strong> (the site keeps it).
                                    Example with <strong>10%</strong>: each player puts in 10 points &rarr; pot 20 &rarr; the site keeps 2 &rarr; the winner gets <strong>18</strong>. With <strong>0%</strong> the winner gets the full 20.
                                    A draw gives everybody their own points back. If nobody joins the room, the host's points are returned.
                                </small>
                                <div class="form-group">
                                    <label for="mistake_{{ $key }}">Computer mistakes</label>
                                    <div class="input-group">
                                        <input type="number" min="0" max="100" step="1" class="form-control" id="mistake_{{ $key }}" name="settings[{{ $key }}][ai_mistake_percent]" value="{{ old('settings.' . $key . '.ai_mistake_percent', $s->option('ai_mistake_percent', 25)) }}">
                                        <div class="input-group-append"><span class="input-group-text">% of its moves are random</span></div>
                                    </div>
                                    <small class="form-text text-muted">
                                        This is how easy the computer is to beat. <strong>0</strong> = it never makes a mistake (on the 3&times;3 grid nobody can beat it, the best a player can get is a draw).
                                        <strong>25</strong> = about one move in four is random. <strong>100</strong> = it plays completely randomly.
                                    </small>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="movesec_{{ $key }}">Time for each online move</label>
                                        <div class="input-group">
                                            <input type="number" min="10" max="600" step="1" class="form-control" id="movesec_{{ $key }}" name="settings[{{ $key }}][move_seconds]" value="{{ old('settings.' . $key . '.move_seconds', $s->option('move_seconds', 60)) }}">
                                            <div class="input-group-append"><span class="input-group-text">seconds</span></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="roommin_{{ $key }}">Room waits for a friend</label>
                                        <div class="input-group">
                                            <input type="number" min="1" max="120" step="1" class="form-control" id="roommin_{{ $key }}" name="settings[{{ $key }}][room_minutes]" value="{{ old('settings.' . $key . '.room_minutes', $s->option('room_minutes', 10)) }}">
                                            <div class="input-group-append"><span class="input-group-text">minutes</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="sameip_{{ $key }}" name="settings[{{ $key }}][block_same_ip]" value="1" {{ old('settings.' . $key . '.block_same_ip', $s->option('block_same_ip', false)) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="sameip_{{ $key }}">Do not allow two players on the same network</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Stops one person opening two accounts on the same Wi-Fi to win points from himself. Turn it off if friends who share a home Wi-Fi should be able to play each other.
                                        A player who does not move within the time above loses the match (and the other player wins the pot). Playing on the same device (offline) never uses or gives points.
                                    </small>
                                </div>
                            @endif

                            @if ($key === 'three_numbers')
                                <div class="form-group mb-0">
                                    <label for="prizes_{{ $key }}">Prize numbers (points for a win)</label>
                                    <input type="text" class="form-control" id="prizes_{{ $key }}" name="settings[{{ $key }}][prizes]" value="{{ old('settings.' . $key . '.prizes', implode(', ', (array) $s->option('prizes', [1]))) }}" placeholder="1, 2, 5, 10, 20, 50, 100">
                                    <small class="form-text text-muted">
                                        When the user wins, one of these numbers is shown on the reels and that many points are added
                                        (<strong>1</strong> shows 001, <strong>100</strong> shows 100). A loss shows 000 and adds nothing.
                                        Whole numbers from 1 to 999, separated by commas. Repeat a number to make it more likely, e.g. <em>1, 1, 1, 2, 5, 100</em>.
                                    </small>
                                </div>
                            @endif

                            @if ($key === 'up_down')
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="minstake_{{ $key }}">Lowest amount</label>
                                        <input type="number" min="1" step="1" class="form-control" id="minstake_{{ $key }}" name="settings[{{ $key }}][min_stake]" value="{{ old('settings.' . $key . '.min_stake', $s->option('min_stake', 1)) }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="maxstake_{{ $key }}">Highest amount</label>
                                        <input type="number" min="1" step="1" class="form-control" id="maxstake_{{ $key }}" name="settings[{{ $key }}][max_stake]" value="{{ old('settings.' . $key . '.max_stake', $s->option('max_stake', 100)) }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="payout_{{ $key }}">Payout on a win</label>
                                        <div class="input-group">
                                            <input type="number" min="0" step="1" class="form-control" id="payout_{{ $key }}" name="settings[{{ $key }}][payout_percent]" value="{{ old('settings.' . $key . '.payout_percent', $s->option('payout_percent', 100)) }}">
                                            <div class="input-group-append"><span class="input-group-text">%</span></div>
                                        </div>
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    The user chooses how many points to put in (between the lowest and highest amount, and never more than they own).
                                    A win adds amount &times; payout% (100% = they win back the same number of points), a loss takes the amount away.
                                </small>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>

</div>

@stop
