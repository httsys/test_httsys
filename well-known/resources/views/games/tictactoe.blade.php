@extends('layouts.front')

@section('title') {{ $game['name'] }} @endsection
@section('meta') {{ $game['tagline'] }} @endsection

@section('content')

@include('games._styles')

<style>
    /* ---- Tic Tac Toe (uses the same panel / buttons / colours as the other mini games) ---- */
    .tt-screen { display: none; }
    .tt-screen.is-on { display: block; animation: mgPop .25s ease; }
    .tt-note { text-align: center; color: #9aa3b8; font-size: 13px; margin: 14px 0 0; }
    .tt-note b { color: #00b5ff; }
    .tt-stack > * + * { margin-top: 12px; }
    .tt-head { text-align: center; font-size: 13px; font-weight: 800; letter-spacing: 1px; color: #9aa3b8; margin: 0 0 14px; text-transform: uppercase; }
    .tt-btn-ghost { background: transparent; border: 1.5px solid rgba(255, 255, 255, .18); color: #cbd5e1; }
    .tt-btn-ghost:hover { background: rgba(255, 255, 255, .06); color: #fff; }
    .tt-btn-sm { padding: 11px; font-size: 14px; }
    .tt-btn-red { background: #ff2e57; }
    .tt-btn-red:hover { background: #e0143f; }

    /* title board on the first screen */
    .tt-art { display: grid; grid-template-columns: repeat(3, 1fr); gap: 7px; max-width: 290px; margin: 2px auto 20px; }
    .tt-art .c { position: relative; background: #1e2230; border-radius: 10px; }
    .tt-art .c::before { content: ''; display: block; padding-top: 100%; }
    .tt-art .c > * { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
    .tt-art .w { display: flex; align-items: center; justify-content: center; font-size: 25px; font-weight: 900; letter-spacing: 1px; color: #fff; }
    .tt-art .w.b { color: #00b5ff; }
    .tt-art svg { padding: 20%; box-sizing: border-box; }

    /* choose a grid */
    .tt-grid-row { display: flex; gap: 12px; justify-content: center; }
    .tt-grid-card { flex: 1 1 0; max-width: 130px; background: #1e2230; border: 1.5px solid rgba(255, 255, 255, .1); border-radius: 12px; padding: 12px 8px 10px; color: #fff; cursor: pointer; text-align: center; transition: border-color .2s, transform .2s; }
    .tt-grid-card:hover { border-color: #0078ff; transform: translateY(-2px); }
    .tt-grid-card .n { font-weight: 800; font-size: 15px; margin-bottom: 8px; }
    .tt-grid-card .mini { display: grid; gap: 2px; width: 70px; height: 70px; margin: 0 auto 8px; }
    .tt-grid-card .mini i { background: #3b4256; border-radius: 2px; display: block; }
    .tt-grid-card .k { font-size: 11px; color: #9aa3b8; font-weight: 700; }

    /* room code */
    .tt-code-box { display: none; background: #1e2230; border: 1.5px dashed rgba(0, 181, 255, .5); border-radius: 12px; padding: 12px; text-align: center; margin: 0 0 14px; }
    .tt-code-box.show { display: block; }
    .tt-code-box small { color: #9aa3b8; display: block; margin-bottom: 4px; font-size: 12px; }
    .tt-code { font-size: 34px; font-weight: 900; letter-spacing: 6px; color: #00b5ff; font-family: "Courier New", monospace; line-height: 1.1; }
    .tt-copy { margin-top: 8px; display: inline-block; border: 0; border-radius: 20px; padding: 6px 16px; background: #0078ff; color: #fff; font-size: 13px; font-weight: 700; cursor: pointer; }
    .tt-copy:hover { background: #0062d1; }
    .tt-join-input { width: 100%; text-align: center; text-transform: uppercase; letter-spacing: 6px; font-size: 26px; font-weight: 800; font-family: "Courier New", monospace; background: #1e2230; border: 1.5px solid rgba(255, 255, 255, .14); border-radius: 10px; color: #fff; padding: 14px 8px; outline: none; }
    .tt-join-input:focus { border-color: #0078ff; }
    .tt-join-input::placeholder { letter-spacing: 2px; font-size: 15px; color: #6b7691; font-weight: 600; }

    /* players strip + status */
    .tt-players { display: flex; gap: 10px; margin: 0 0 12px; }
    .tt-chip { flex: 1 1 0; min-width: 0; display: flex; align-items: center; gap: 8px; background: #1e2230; border: 1.5px solid transparent; border-radius: 10px; padding: 8px 10px; font-size: 13px; font-weight: 700; color: #cbd5e1; transition: border-color .2s; }
    .tt-chip.on { border-color: #0078ff; color: #fff; }
    .tt-chip .sym { flex: 0 0 22px; width: 22px; height: 22px; }
    .tt-chip .who { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .tt-status { text-align: center; font-size: 16px; font-weight: 800; min-height: 24px; margin: 0 0 4px; }
    .tt-timer { text-align: center; font-size: 12px; color: #9aa3b8; min-height: 18px; margin: 0 0 10px; }
    .tt-timer.low { color: #ff9fb3; }
    .tt-rule { text-align: center; font-size: 12px; color: #9aa3b8; margin: 10px 0 0; }

    /* board */
    .tt-board { display: grid; gap: 6px; width: 100%; max-width: 380px; margin: 0 auto; }
    .tt-board.s5 { gap: 5px; }
    .tt-board.s7 { gap: 4px; }
    .tt-cell { position: relative; display: block; width: 100%; padding: 0; border: 0; border-radius: 10px; background: #1e2230; cursor: default; transition: background .15s; }
    .tt-board.s7 .tt-cell { border-radius: 7px; }
    .tt-cell::before { content: ''; display: block; padding-top: 100%; }
    .tt-board.playable .tt-cell:not(:disabled) { cursor: pointer; }
    .tt-board.playable .tt-cell:not(:disabled):hover { background: #2a3045; }
    .tt-cell svg { position: absolute; top: 0; left: 0; width: 100%; height: 100%; padding: 17%; box-sizing: border-box; }
    .tt-cell.last { box-shadow: inset 0 0 0 2px rgba(255, 255, 255, .22); }
    .tt-cell.win { background: rgba(0, 181, 255, .2); box-shadow: inset 0 0 0 2px #00b5ff; }
    .tt-cell svg.fresh path, .tt-cell svg.fresh circle { stroke-dasharray: 200; stroke-dashoffset: 200; animation: ttDraw .35s ease forwards; }
    @keyframes ttDraw { to { stroke-dashoffset: 0; } }

    .tt-actions { display: flex; gap: 10px; margin-top: 16px; }
    .tt-actions .mg-btn { flex: 1; }
    .tt-result-wrap { margin-top: 14px; }
    .tt-result-wrap .mg-result { margin-bottom: 10px; }
    .mg-msg.info { display: block; background: rgba(0, 120, 255, .22); color: #8fd6ff; }

    /* points to play for (create room) */
    .tt-stake-box { display: none; margin-top: 16px; background: #1e2230; border: 1.5px solid rgba(255, 255, 255, .1); border-radius: 12px; padding: 12px 14px; }
    .tt-stake-box.show { display: block; }
    .tt-stake-box label { display: block; font-size: 12px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; color: #9aa3b8; margin: 0 0 8px; }
    .tt-stake-row { display: flex; gap: 8px; }
    .tt-stake-row input { flex: 1; min-width: 0; background: #12161f; border: 1.5px solid rgba(255, 255, 255, .14); border-radius: 8px; color: #fff; font-size: 22px; font-weight: 800; text-align: center; padding: 8px; outline: none; -moz-appearance: textfield; }
    .tt-stake-row input:focus { border-color: #0078ff; }
    .tt-stake-row input::-webkit-outer-spin-button, .tt-stake-row input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    .tt-stake-row button { flex: 0 0 auto; border: 0; border-radius: 8px; background: #0078ff; color: #fff; font-weight: 800; font-size: 13px; padding: 0 16px; cursor: pointer; }
    .tt-stake-row button:hover { background: #0062d1; }
    .tt-stake-box small { display: block; margin-top: 8px; color: #9aa3b8; font-size: 12px; line-height: 1.5; }
    .tt-stake-box small b { color: #00b5ff; }

    /* what is being played for, inside a match */
    .tt-stake-info { display: none; text-align: center; font-size: 12px; font-weight: 700; color: #9aa3b8; margin: 0 0 8px; }
    .tt-stake-info.show { display: block; }
    .tt-stake-info b { color: #00b5ff; }

    /* "friend did not accept" notice for the host */
    .tt-notice { display: none; align-items: flex-start; gap: 10px; margin: 0 0 12px; padding: 11px 12px; border-radius: 10px; background: rgba(255, 46, 87, .15); color: #ff9fb3; font-size: 13px; font-weight: 600; line-height: 1.45; }
    .tt-notice.show { display: flex; }
    .tt-notice span { flex: 1; }
    .tt-notice button { flex: 0 0 auto; border: 0; background: transparent; color: #ff9fb3; font-size: 22px; line-height: 1; cursor: pointer; padding: 0 2px; }

    /* "Join this game?" dialog */
    .tt-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 100000; background: rgba(12, 15, 24, .78); align-items: center; justify-content: center; padding: 16px; overflow-y: auto; }
    .tt-overlay.show { display: flex; }
    .tt-dialog { width: 100%; max-width: 380px; background: #262b3a; color: #fff; border-radius: 16px; padding: 20px 18px 18px; box-shadow: 0 20px 60px rgba(0, 0, 0, .5); animation: mgPop .25s ease; }
    .tt-dialog h4 { margin: 0 0 10px; font-size: 20px; font-weight: 800; color: #fff; text-align: center; }
    .tt-dlg-points { text-align: center; margin: 0 0 12px; }
    .tt-dlg-points b { display: block; font-size: 44px; line-height: 1.05; font-weight: 900; color: #00b5ff; }
    .tt-dlg-points span { font-size: 13px; font-weight: 700; color: #9aa3b8; letter-spacing: 1px; text-transform: uppercase; }
    .tt-dlg-rows { background: #1e2230; border-radius: 10px; padding: 4px 12px; margin: 0 0 12px; }
    .tt-dlg-rows > div { display: flex; justify-content: space-between; gap: 10px; padding: 8px 0; font-size: 14px; border-bottom: 1px solid rgba(255, 255, 255, .06); }
    .tt-dlg-rows > div:last-child { border-bottom: 0; }
    .tt-dlg-rows span { color: #9aa3b8; }
    .tt-dlg-rows b { color: #fff; text-align: right; }
    .tt-dlg-rows b.hi { color: #00b5ff; }
    .tt-dlg-note { margin: 0 0 12px; text-align: center; font-size: 12px; color: #9aa3b8; }
    .tt-dlg-warn { display: none; margin: 0 0 12px; padding: 11px 12px; border-radius: 10px; background: rgba(255, 46, 87, .15); color: #ff9fb3; font-size: 13px; font-weight: 600; line-height: 1.45; text-align: center; }
    .tt-dlg-warn.show { display: block; }
    .tt-dlg-add { display: inline-block; margin-top: 8px; padding: 7px 16px; border-radius: 20px; background: #ff2e57; color: #fff !important; font-weight: 800; font-size: 13px; text-decoration: none !important; }
    .tt-dlg-add:hover { background: #e0143f; }
    .tt-dlg-actions { display: flex; gap: 10px; }
    .tt-dlg-actions .mg-btn { flex: 1; padding: 13px; }
</style>

<div class="breadcrumb-area">
    <div class="container">
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">Home</a></li>
            <li class="separator separator-home"></li>
            <li class="item-home"><a class="bread-link" href="{{ route('games.index') }}">{{ __('Mini Games') }}</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">{{ $game['name'] }}</li>
        </ul>
        <h1 class="breadcrumb-title">{{ $game['name'] }}</h1>
        <ul class="shape-group-code">
            <li class="shape shape-1"><img src="/public/img/bubble-9.png" alt="circle"></li>
            <li class="shape shape-2"><img src="/public/img/bubble-17.png" alt="circle"></li>
            <li class="shape shape-3"><img src="/public/img/line-4.png" alt="circle"></li>
        </ul>
    </div>
</div>

<div class="blog-page-section">
<div class="container">

    <div class="mg-panel">
        <div class="mg-panel-top">
            <div class="mg-icon" style="background: rgba(0,181,255,.18); color:#00b5ff;"><i class="fas fa-th"></i></div>
            <h3>{{ $game['name'] }}</h3>
            <p>{{ __($game['tagline']) }}</p>
        </div>

        <div class="mg-panel-body">
            <div class="mg-left-bar">
                <i class="far fa-dot-circle"></i> {{ __('Matches Left') }}:
                <span style="color:#00b5ff;">{{ $remaining === null ? __('Unlimited') : $remaining }}</span>
            </div>

            {{-- 1. Menu --}}
            <div class="tt-screen is-on" id="ttMenu">
                <div class="tt-art" aria-hidden="true">
                    <div class="c"><div class="w">TIC</div></div>
                    <div class="c"><svg viewBox="0 0 100 100"><path d="M18 18 L82 82 M82 18 L18 82" stroke="#ff2e57" stroke-width="13" stroke-linecap="round" fill="none"/></svg></div>
                    <div class="c"><svg viewBox="0 0 100 100"><circle cx="50" cy="50" r="33" stroke="#00b5ff" stroke-width="13" fill="none"/></svg></div>
                    <div class="c"><svg viewBox="0 0 100 100"><path d="M18 18 L82 82 M82 18 L18 82" stroke="#ff2e57" stroke-width="13" stroke-linecap="round" fill="none"/></svg></div>
                    <div class="c"><div class="w b">TAC</div></div>
                    <div class="c"><svg viewBox="0 0 100 100"><path d="M18 18 L82 82 M82 18 L18 82" stroke="#ff2e57" stroke-width="13" stroke-linecap="round" fill="none"/></svg></div>
                    <div class="c"><svg viewBox="0 0 100 100"><circle cx="50" cy="50" r="33" stroke="#00b5ff" stroke-width="13" fill="none"/></svg></div>
                    <div class="c"><svg viewBox="0 0 100 100"><path d="M18 18 L82 82 M82 18 L18 82" stroke="#ff2e57" stroke-width="13" stroke-linecap="round" fill="none"/></svg></div>
                    <div class="c"><div class="w">TOE</div></div>
                </div>
                <div class="tt-stack">
                    <button type="button" class="mg-btn" id="ttOnePlayer"><i class="fas fa-robot"></i> {{ __('1 Player') }}</button>
                    <button type="button" class="mg-btn teal" id="ttTwoPlayers"><i class="fas fa-user-friends"></i> {{ __('2 Players') }}</button>
                </div>
                <p class="tt-note">
                    {{ __('Beat the computer') }}: <b>+{{ $aiPoints }}</b> {{ $aiPoints == 1 ? __('point') : __('points') }}
                    &nbsp;&bull;&nbsp;
                    {{ __('Online') }}: {{ __('winner takes the pot') }}@if ($feePercent > 0) ({{ $feePercent }}% {{ __('fee') }})@endif
                </p>
            </div>

            {{-- 2. Two players: offline or online --}}
            <div class="tt-screen" id="ttPlayers">
                <p class="tt-head">{{ __('2 Players') }}</p>
                <div class="tt-stack">
                    <button type="button" class="mg-btn" id="ttOffline"><i class="fas fa-mobile-alt"></i> {{ __('Offline - same device') }}</button>
                    <button type="button" class="mg-btn teal" id="ttOnline"><i class="fas fa-globe"></i> {{ __('Online - play a friend') }}</button>
                    <button type="button" class="mg-btn tt-btn-ghost tt-btn-sm js-back" data-to="ttMenu"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</button>
                </div>
                <p class="tt-note">{{ __('Offline: two players take turns on this screen (no points). Online: each player uses their own phone, both put in the same points and the winner takes them.') }}</p>
            </div>

            {{-- 3. Online: create or enter a room --}}
            <div class="tt-screen" id="ttOnlineMenu">
                <p class="tt-head">{{ __('Play online') }}</p>
                <div class="tt-stack">
                    <button type="button" class="mg-btn" id="ttCreate"><i class="fas fa-plus-circle"></i> {{ __('Create Room') }}</button>
                    <button type="button" class="mg-btn teal" id="ttEnter"><i class="fas fa-sign-in-alt"></i> {{ __('Enter Room') }}</button>
                    <button type="button" class="mg-btn tt-btn-ghost tt-btn-sm js-back" data-to="ttPlayers"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</button>
                </div>
                <p class="tt-note">{{ __('Create a room, choose the points to play for and send the code to your friend. Or enter the code your friend gave you.') }}</p>
            </div>

            {{-- 4. Enter a room code --}}
            <div class="tt-screen" id="ttJoin">
                <p class="tt-head">{{ __('Enter Room') }}</p>
                <div class="tt-stack">
                    <input type="text" class="tt-join-input" id="ttJoinCode" maxlength="8" autocomplete="off" autocapitalize="characters" spellcheck="false" placeholder="{{ __('ROOM CODE') }}">
                    <button type="button" class="mg-btn" id="ttJoinBtn"><i class="fas fa-search"></i> {{ __('Find Room') }}</button>
                    <button type="button" class="mg-btn tt-btn-ghost tt-btn-sm js-back" data-to="ttOnlineMenu"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</button>
                </div>
            </div>

            {{-- 5. Choose a grid --}}
            <div class="tt-screen" id="ttGrid">
                <p class="tt-head">{{ __('Choose a grid') }}</p>
                <div class="tt-grid-row">
                    @foreach ($winLengths as $n => $len)
                        <button type="button" class="tt-grid-card js-grid" data-size="{{ $n }}">
                            <div class="n">{{ $n }}&times;{{ $n }}</div>
                            <div class="mini" style="grid-template-columns: repeat({{ $n }}, 1fr); grid-template-rows: repeat({{ $n }}, 1fr);">
                                @for ($i = 0; $i < $n * $n; $i++)<i></i>@endfor
                            </div>
                            <div class="k">{{ $len }} {{ __('in a row') }}</div>
                        </button>
                    @endforeach
                </div>
                {{-- Only when creating an online room: how many points to play for --}}
                <div class="tt-stake-box" id="ttStakeBox">
                    <label for="ttStake">{{ __('Points to play for') }}</label>
                    <div class="tt-stake-row">
                        <input type="number" id="ttStake" min="1" step="1" inputmode="numeric" placeholder="0">
                        <button type="button" id="ttStakeMax">{{ __('Max') }}</button>
                    </div>
                    <small id="ttStakeHint"></small>
                </div>
                <div class="tt-stack" style="margin-top:16px;">
                    <button type="button" class="mg-btn tt-btn-ghost tt-btn-sm" id="ttGridBack"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</button>
                </div>
            </div>

            {{-- 6. The game --}}
            <div class="tt-screen" id="ttGame">
                <div class="tt-code-box" id="ttCodeBox">
                    <small>{{ __('Send this code to your friend') }}</small>
                    <div class="tt-code" id="ttCode">------</div>
                    <button type="button" class="tt-copy" id="ttCopy"><i class="far fa-copy"></i> {{ __('Copy code') }}</button>
                </div>

                <div class="tt-notice" id="ttNotice">
                    <span id="ttNoticeText"></span>
                    <button type="button" id="ttNoticeX" aria-label="{{ __('Close') }}">&times;</button>
                </div>

                <div class="tt-players">
                    <div class="tt-chip" id="ttChipX"><svg class="sym" viewBox="0 0 100 100"><path d="M18 18 L82 82 M82 18 L18 82" stroke="#ff2e57" stroke-width="14" stroke-linecap="round" fill="none"/></svg><span class="who" id="ttWhoX">-</span></div>
                    <div class="tt-chip" id="ttChipO"><svg class="sym" viewBox="0 0 100 100"><circle cx="50" cy="50" r="32" stroke="#00b5ff" stroke-width="14" fill="none"/></svg><span class="who" id="ttWhoO">-</span></div>
                </div>

                <div class="tt-stake-info" id="ttStakeInfo"></div>
                <div class="tt-status" id="ttStatus"></div>
                <div class="tt-timer" id="ttTimer"></div>

                <div class="tt-board s3" id="ttBoard"></div>
                <p class="tt-rule" id="ttRule"></p>

                <div class="tt-result-wrap">
                    <div class="mg-result" id="ttResult">
                        <div class="mg-result-title" id="ttResultTitle"></div>
                        <div class="mg-result-sub" id="ttResultSub"></div>
                    </div>
                </div>

                <div class="tt-actions">
                    <button type="button" class="mg-btn" id="ttAgain" style="display:none;"><i class="fas fa-redo"></i> {{ __('Play Again') }}</button>
                    <button type="button" class="mg-btn tt-btn-ghost" id="ttLeave"><i class="fas fa-sign-out-alt"></i> <span id="ttLeaveText">{{ __('Leave') }}</span></button>
                </div>
            </div>

            <div class="mg-msg" id="ttMsg"></div>
        </div>

        <div class="mg-panel-foot"><i class="far fa-question-circle"></i> {{ __('Get your marks in a row before your opponent does!') }}</div>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('games.index') }}" class="mg-points-pill"><i class="fas fa-arrow-left"></i> {{ __('All Mini Games') }}</a>
        @if ($isGuest)
            <a href="{{ route('login') }}?redirect_to={{ urlencode(url()->current()) }}" class="mg-points-pill"><i class="fas fa-sign-in-alt"></i> {{ __('Login to play for points') }}</a>
        @else
            <a href="{{ route('profile.show') }}#points" class="mg-points-pill"><i class="fas fa-coins"></i> {{ __('My Points') }}: <span id="mgPoints">{{ number_format($points) }}</span></a>
        @endif
    </div>

</div>
</div>

{{-- "Join this game?" - what the friend sees after typing a room code --}}
<div class="tt-overlay" id="ttDialog" role="dialog" aria-modal="true" aria-labelledby="dlgTitle">
    <div class="tt-dialog">
        <h4 id="dlgTitle">{{ __('Join this game?') }}</h4>
        <div class="tt-dlg-points"><b id="dlgStake">0</b><span>{{ __('points each') }}</span></div>
        <div class="tt-dlg-rows">
            <div><span>{{ __('Room') }}</span><b id="dlgCode">-</b></div>
            <div><span>{{ __('Opened by') }}</span><b id="dlgHost">-</b></div>
            <div><span>{{ __('Grid') }}</span><b id="dlgGrid">-</b></div>
            <div><span>{{ __('Total pot') }}</span><b id="dlgPot">-</b></div>
            <div id="dlgFeeRow"><span id="dlgFeeLabel">{{ __('Fee') }}</span><b id="dlgFee">-</b></div>
            <div><span>{{ __('Winner gets') }}</span><b id="dlgPayout" class="hi">-</b></div>
            <div><span>{{ __('Your points') }}</span><b id="dlgBalance">-</b></div>
        </div>
        <p class="tt-dlg-note" id="dlgNote">{{ __('If you join, the same points are taken from your account now.') }}</p>
        <div class="tt-dlg-warn" id="dlgWarn">
            <span id="dlgWarnText"></span>
            <a href="{{ route('profile.show') }}#points" class="tt-dlg-add"><i class="fas fa-plus-circle"></i> {{ __('Add points') }}</a>
        </div>
        <div class="tt-dlg-actions">
            <button type="button" class="mg-btn tt-btn-ghost" id="dlgCancel">{{ __('Cancel') }}</button>
            <button type="button" class="mg-btn" id="dlgJoin"><i class="fas fa-play"></i> {{ __('Join Game') }}</button>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict';

    var BASE = @json(url('/mini-games/tic-tac-toe/match'));
    var loginUrl = @json(route('login'));
    var isGuest = @json((bool) $isGuest);
    var active = @json((bool) $setting->is_active);
    var remaining = @json($remaining);
    var activeMatchId = @json($activeMatchId);
    var moveSeconds = @json((int) $moveSeconds);
    var WIN_LEN = @json($winLengths);
    var FEE = @json((int) $feePercent);

    var T = {
        yourTurn: @json(__('Your turn')),
        turnOf: @json(__(":name's turn")),
        thinking: @json(__('Computer is thinking...')),
        waiting: @json(__('Waiting for your friend to join...')),
        roomClosed: @json(__('This room was closed.')),
        you: @json(__('You')),
        computer: @json(__('Computer')),
        friend: @json(__('Friend')),
        player1: @json(__('Player 1')),
        player2: @json(__('Player 2')),
        won: @json(__('You won!')),
        lost: @json(__('You lost')),
        draw: @json(__("It's a draw")),
        winLine: @json(__('Nice game - you got your marks in a row.')),
        betterLuck: @json(__('Better luck next time.')),
        drawSub: @json(__('No points this time.')),
        oppTimeout: @json(__('Your opponent ran out of time.')),
        oppLeft: @json(__('Your opponent left the match.')),
        youTimeout: @json(__('You ran out of time.')),
        youLeft: @json(__('You left the match.')),
        point: @json(__('point')),
        points: @json(__('points')),
        xWins: @json(__('Player X wins!')),
        oWins: @json(__('Player O wins!')),
        offlineNote: @json(__('Playing on one device does not earn points.')),
        timeLeft: @json(__('Time left')),
        inARow: @json(__('in a row to win')),
        leave: @json(__('Leave')),
        menu: @json(__('Menu')),
        confirmLeave: @json(__('Leave this match? You will lose it.')),
        copied: @json(__('Copied!')),
        copy: @json(__('Copy code')),
        unavailable: @json(__('This game is currently unavailable.')),
        limit: @json(__('You have used all your matches for this hour. Please come back later.')),
        network: @json(__('Network error. Please try again.')),
        wrong: @json(__('Something went wrong. Please try again.')),
        enterCode: @json(__('Please enter the room code.')),
        roomClosedRefund: @json(__('This room was closed. Your points were returned.')),
        cancelled: @json(__('Request cancelled.')),
        playingFor: @json(__('Playing for')),
        pointsEach: @json(__('points each')),
        winnerGets: @json(__('Winner gets')),
        stakeNeed: @json(__('Please enter how many points you want to play for.')),
        stakeMore: @json(__('You only have :amount points.')),
        stakeHint: @json(__('Your points: :bal. Your friend must put in the same amount. The winner gets both, minus :fee% fee.')),
        stakeHintNoFee: @json(__('Your points: :bal. Your friend must put in the same amount. The winner gets both.')),
        declined: @json(__(':who did not accept :amount points and does not want to play.')),
        declinedHint: @json(__('Your room is still open - wait for someone else, or leave to get your points back.')),
        winPot: @json(__('You received :amount points (pot :pot minus :fee fee).')),
        winPotNoFee: @json(__('You received :amount points (the whole pot).')),
        lostPoints: @json(__('You lost :amount points.')),
        drawRefund: @json(__("It's a draw. Your :amount points were returned.")),
        confirmLeavePts: @json(__('Leave this match? You will lose your :amount points.')),
        lowBalance: @json(__('You need :need points to join this game but you only have :bal. Please add points to your account and try again.')),
        fee: @json(__('Fee')),
        none: @json(__('None'))
    };

    var tokenMeta = document.querySelector('meta[name="csrf-token"]');
    var token = tokenMeta ? tokenMeta.getAttribute('content') : '';

    function $(id) { return document.getElementById(id); }
    var msg = $('ttMsg');

    var S = {
        mode: null,      // 'ai' | 'offline' | 'create' | 'join'
        size: 3,
        match: null,     // last server state
        local: null,     // offline game
        busy: false,
        pollTimer: null,
        tickTimer: null,
        moveLeft: null,
        stateAt: 0,
        gridFor: null,   // what the grid screen was opened for
        balance: @json((int) ($points ?? 0)),   // the player's points (kept up to date from the server)
        lastStake: null, // points of the last room he opened (suggested again for "Play Again")
        lastDeclined: 0, // time of the last "friend said no" notice already shown
        pendingCode: null // room code shown in the dialog
    };

    /* ENGINE-START (same rules as the server; used for the offline mode) */
    function evaluate(board, size, winLen) {
        var dirs = [[0, 1], [1, 0], [1, 1], [1, -1]];
        for (var r = 0; r < size; r++) {
            for (var c = 0; c < size; c++) {
                var s = board.charAt(r * size + c);
                if (s === '-') { continue; }
                for (var d = 0; d < dirs.length; d++) {
                    var dr = dirs[d][0], dc = dirs[d][1];
                    var pr = r - dr, pc = c - dc;
                    if (pr >= 0 && pr < size && pc >= 0 && pc < size && board.charAt(pr * size + pc) === s) { continue; }
                    var cells = [], rr = r, cc = c;
                    while (rr >= 0 && rr < size && cc >= 0 && cc < size && board.charAt(rr * size + cc) === s) {
                        cells.push(rr * size + cc);
                        rr += dr; cc += dc;
                    }
                    if (cells.length >= winLen) { return { status: 'win', symbol: s, cells: cells }; }
                }
            }
        }
        if (board.indexOf('-') === -1) { return { status: 'draw', symbol: null, cells: [] }; }
        return { status: 'playing', symbol: null, cells: [] };
    }
    /* ENGINE-END */

    /* ---------------- small helpers ---------------- */

    function showScreen(id) {
        var all = document.querySelectorAll('.tt-screen');
        for (var i = 0; i < all.length; i++) { all[i].classList.remove('is-on'); }
        $(id).classList.add('is-on');
        clearMsg();
    }

    function showError(text) { msg.textContent = text; msg.className = 'mg-msg error'; }
    function clearMsg() { msg.textContent = ''; msg.className = 'mg-msg'; }
    function showInfo(text) { msg.textContent = text; msg.className = 'mg-msg info'; }

    // Best message out of a server answer (validation errors come as {errors: {field: [text]}}).
    function msgFrom(r) {
        var d = r && r.data ? r.data : {};
        if (d.errors) {
            for (var k in d.errors) {
                if (d.errors[k] && d.errors[k][0]) { return d.errors[k][0]; }
            }
        }
        return d.message || T.wrong;
    }

    // The player's points, kept in step with the server (stakes are taken / paid out during a match).
    function setBalance(n) {
        S.balance = Number(n);
        var pts = $('mgPoints');
        if (pts) { pts.textContent = S.balance.toLocaleString(); }
    }

    function showNotice(text) { $('ttNoticeText').textContent = text; $('ttNotice').classList.add('show'); }
    function hideNotice() { $('ttNotice').classList.remove('show'); }

    function loginRedirect() {
        window.location.href = loginUrl + '?redirect_to=' + encodeURIComponent(window.location.href);
    }

    function api(method, url, body) {
        var opts = {
            method: method,
            credentials: 'same-origin',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': token
            }
        };
        if (body) {
            opts.headers['Content-Type'] = 'application/json';
            opts.body = JSON.stringify(body);
        }
        return fetch(url, opts).then(function (res) {
            if (res.status === 401) { loginRedirect(); return { ok: false, status: 401, data: {} }; }
            return res.json().then(function (data) {
                return { ok: res.ok, status: res.status, data: data };
            }, function () {
                return { ok: false, status: res.status, data: {} };
            });
        });
    }

    function markSvg(sym, fresh) {
        var cls = fresh ? ' class="fresh"' : '';
        if (sym === 'X') {
            return '<svg viewBox="0 0 100 100"' + cls + '><path d="M18 18 L82 82 M82 18 L18 82" stroke="#ff2e57" stroke-width="13" stroke-linecap="round" fill="none"/></svg>';
        }
        return '<svg viewBox="0 0 100 100"' + cls + '><circle cx="50" cy="50" r="32" stroke="#00b5ff" stroke-width="13" fill="none"/></svg>';
    }

    /* ---------------- the board ---------------- */

    var boardEl = $('ttBoard');
    var builtSize = 0;
    var drawn = '';

    function buildBoard(size) {
        if (builtSize === size && boardEl.children.length === size * size) { return; }
        builtSize = size;
        drawn = new Array(size * size + 1).join('-');
        boardEl.innerHTML = '';
        boardEl.className = 'tt-board s' + size;
        boardEl.style.gridTemplateColumns = 'repeat(' + size + ', 1fr)';
        for (var i = 0; i < size * size; i++) {
            var b = document.createElement('button');
            b.type = 'button';
            b.className = 'tt-cell';
            b.setAttribute('data-i', i);
            b.setAttribute('aria-label', (Math.floor(i / size) + 1) + ',' + (i % size + 1));
            boardEl.appendChild(b);
        }
    }

    function drawBoard(board, winCells, lastCell, playable) {
        var cells = boardEl.children;
        for (var i = 0; i < cells.length; i++) {
            var ch = board.charAt(i);
            var el = cells[i];
            if (drawn.charAt(i) !== ch) {
                el.innerHTML = ch === '-' ? '' : markSvg(ch, drawn.charAt(i) === '-');
            }
            el.disabled = !(playable && ch === '-');
            el.classList.toggle('win', winCells.indexOf(i) !== -1);
            el.classList.toggle('last', winCells.length === 0 && lastCell === i);
        }
        drawn = board;
        boardEl.classList.toggle('playable', !!playable);
    }

    function setChips(xName, oName, turn, finished) {
        $('ttWhoX').textContent = xName;
        $('ttWhoO').textContent = oName;
        $('ttChipX').classList.toggle('on', !finished && turn === 'X');
        $('ttChipO').classList.toggle('on', !finished && turn === 'O');
    }

    function showResultBox(kind, title, sub) {
        var box = $('ttResult');
        box.className = 'mg-result show ' + (kind === 'win' ? 'win' : 'lose');
        $('ttResultTitle').textContent = title;
        $('ttResultSub').textContent = sub;
    }

    function hideResultBox() { $('ttResult').className = 'mg-result'; }

    function pointsText(n) { return '+' + n + ' ' + (n === 1 ? T.point : T.points) + '.'; }

    /* ---------------- server matches (vs computer / online) ---------------- */

    function stopTimers() {
        clearTimeout(S.pollTimer);
        clearInterval(S.tickTimer);
        S.pollTimer = null;
        S.tickTimer = null;
    }

    function goMenu() {
        stopTimers();
        S.match = null;
        S.local = null;
        S.busy = false;
        hideResultBox();
        hideNotice();
        showScreen('ttMenu');
    }

    function enterGame() {
        hideResultBox();
        $('ttAgain').style.display = 'none';
        showScreen('ttGame');
    }

    function renderMatch(st, maskCell) {
        S.match = st;
        S.size = st.size;
        if (typeof st.balance === 'number') { setBalance(st.balance); }
        buildBoard(st.size);

        var board = st.board;
        if (typeof maskCell === 'number') {
            board = board.substr(0, maskCell) + '-' + board.substr(maskCell + 1);
        }

        var thinking = typeof maskCell === 'number';
        // While the computer's reply is still being "thought about" the game is not shown as over yet.
        var finished = (st.status === 'finished' || st.status === 'cancelled') && !thinking;
        var myTurn = st.status === 'active' && st.turn === st.you && !thinking && !S.busy;

        drawBoard(board, thinking ? [] : st.win_cells, st.last_cell, myTurn);

        // who is who
        var xName, oName;
        if (st.mode === 'ai') {
            xName = T.you; oName = T.computer;
        } else if (st.you === 'X') {
            xName = T.you; oName = st.opponent || '...';
        } else {
            xName = st.opponent || '...'; oName = T.you;
        }
        setChips(xName, oName, thinking ? 'O' : st.turn, finished || st.status === 'waiting');

        $('ttRule').textContent = st.win_len + ' ' + T.inARow;

        // room code
        var codeBox = $('ttCodeBox');
        if (st.code) {
            $('ttCode').textContent = st.code;
            codeBox.classList.add('show');
        } else {
            codeBox.classList.remove('show');
        }

        // what is being played for (online matches)
        var info = $('ttStakeInfo');
        if (st.mode === 'online' && st.stake > 0) {
            info.innerHTML = T.playingFor + ' <b>' + Number(st.stake) + '</b> ' + T.pointsEach + ' &middot; ' + T.winnerGets + ' <b>' + Number(st.payout) + '</b>';
            info.classList.add('show');
        } else {
            info.classList.remove('show');
        }

        // a friend looked at the room and did not accept the points
        if (st.declined && st.declined.at !== S.lastDeclined) {
            S.lastDeclined = st.declined.at;
            showNotice(T.declined.replace(':who', st.declined.name).replace(':amount', st.stake) + ' ' + T.declinedHint);
        } else if (st.status !== 'waiting') {
            hideNotice();
        }

        // status line
        var status = '';
        if (thinking) {
            status = T.thinking;
        } else if (st.status === 'waiting') {
            status = T.waiting;
        } else if (st.status === 'cancelled') {
            status = st.stake > 0 ? T.roomClosedRefund : T.roomClosed;
        } else if (st.status === 'active') {
            if (st.turn === st.you) {
                status = T.yourTurn + ' (' + st.you + ')';
            } else {
                status = T.turnOf.replace(':name', st.opponent || T.friend);
            }
        }
        $('ttStatus').textContent = status;

        // leave button / play again
        $('ttLeaveText').textContent = finished ? T.menu : T.leave;
        if (finished) {
            $('ttAgain').style.display = (st.status === 'cancelled') ? 'none' : '';
            showFinished(st);
        } else {
            $('ttAgain').style.display = 'none';
            hideResultBox();
        }

        // move timer (online)
        S.moveLeft = st.move_left;
        S.stateAt = Date.now();
        updateTimer();
        clearInterval(S.tickTimer);
        S.tickTimer = null;
        if (st.status === 'active' && st.mode === 'online') {
            S.tickTimer = setInterval(updateTimer, 500);
        }

        // polling (online only)
        clearTimeout(S.pollTimer);
        S.pollTimer = null;
        if (st.mode === 'online' && (st.status === 'waiting' || st.status === 'active')) {
            schedulePoll();
        }
    }

    function showFinished(st) {
        $('ttTimer').textContent = '';
        if (st.status === 'cancelled') { return; }

        var forPoints = st.mode === 'online' && st.stake > 0;

        if (st.result === 'win') {
            var sub = st.reason === 'timeout' ? T.oppTimeout : (st.reason === 'left' ? T.oppLeft : T.winLine);
            if (forPoints) {
                sub += ' ' + (st.fee_amount > 0
                    ? T.winPot.replace(':amount', st.payout).replace(':pot', st.pot).replace(':fee', st.fee_amount)
                    : T.winPotNoFee.replace(':amount', st.payout));
            } else if (st.points > 0) {
                sub += ' ' + pointsText(st.points);
            }
            showResultBox('win', T.won, sub);
        } else if (st.result === 'lose') {
            var lsub = st.reason === 'timeout' ? T.youTimeout : (st.reason === 'left' ? T.youLeft : T.betterLuck);
            if (forPoints) { lsub += ' ' + T.lostPoints.replace(':amount', st.stake); }
            showResultBox('lose', T.lost, lsub);
        } else {
            showResultBox('lose', T.draw, forPoints ? T.drawRefund.replace(':amount', st.stake) : T.drawSub);
        }

    }

    function updateTimer() {
        var el = $('ttTimer');
        var st = S.match;
        if (!st || st.status !== 'active' || st.mode !== 'online' || S.moveLeft === null || S.moveLeft === undefined) {
            if (!st || st.status === 'active' || st.status === 'waiting') { el.textContent = ''; }
            el.classList.remove('low');
            return;
        }
        var left = Math.max(0, S.moveLeft - Math.floor((Date.now() - S.stateAt) / 1000));
        el.textContent = T.timeLeft + ': ' + left + 's';
        el.classList.toggle('low', left <= 10);
    }

    function schedulePoll() {
        clearTimeout(S.pollTimer);
        S.pollTimer = setTimeout(doPoll, document.hidden ? 4000 : 1500);
    }

    function doPoll() {
        var st = S.match;
        if (!st) { return; }
        var id = st.id;

        api('GET', BASE + '/' + id + '/state').then(function (r) {
            if (!S.match || S.match.id !== id) { return; }
            if (r.status === 404) { goMenu(); return; }
            if (r.ok && r.data.state) {
                if (S.busy) { schedulePoll(); return; }
                renderMatch(r.data.state);
            } else {
                schedulePoll();
            }
        }).catch(function () {
            if (S.match && S.match.id === id) { schedulePoll(); }
        });
    }

    function startServerMatch(kind, size, stake) {
        if (isGuest) { loginRedirect(); return; }
        if (!active) { showError(T.unavailable); return; }
        if (remaining !== null && remaining <= 0) { showError(T.limit); return; }
        if (S.busy) { return; }
        S.busy = true;
        clearMsg();

        var url = kind === 'ai' ? BASE + '/ai' : BASE + '/room';
        var body = kind === 'ai' ? { size: size } : { size: size, stake: stake };
        api('POST', url, body).then(function (r) {
            S.busy = false;
            if (r.ok && r.data.state) {
                S.mode = kind === 'ai' ? 'ai' : 'create';
                S.size = size;
                enterGame();
                renderMatch(r.data.state);
            } else if (r.status !== 401) {
                showScreen('ttGrid');
                showError(msgFrom(r));
            }
        }).catch(function () {
            S.busy = false;
            showError(T.network);
        });
    }

    /* ---- Enter Room: look at the room first, then decide ---- */

    function findRoom() {
        if (isGuest) { loginRedirect(); return; }
        var code = $('ttJoinCode').value.replace(/[^A-Za-z0-9]/g, '').toUpperCase();
        if (code.length < 4) { showError(T.enterCode); return; }
        if (S.busy) { return; }
        S.busy = true;
        clearMsg();

        api('POST', BASE + '/preview', { code: code }).then(function (r) {
            S.busy = false;
            if (r.ok && r.data.room) {
                if (r.data.room.rejoin) {
                    doJoin(code);          // already one of the two players: just go back in
                } else {
                    openDialog(r.data.room);
                }
            } else if (r.status !== 401) {
                showError(msgFrom(r));
            }
        }).catch(function () {
            S.busy = false;
            showError(T.network);
        });
    }

    function showLowBalance(need, bal) {
        $('dlgWarnText').textContent = T.lowBalance.replace(':need', need).replace(':bal', bal);
        $('dlgWarn').classList.add('show');
        $('dlgNote').style.display = 'none';
        $('dlgJoin').disabled = true;
    }

    function openDialog(room) {
        S.pendingCode = room.code;
        $('dlgStake').textContent = room.stake;
        $('dlgCode').textContent = room.code;
        $('dlgHost').textContent = room.host;
        $('dlgGrid').textContent = room.size + '\u00d7' + room.size + ' (' + room.win_len + ' ' + T.inARow + ')';
        $('dlgPot').textContent = room.pot;
        $('dlgFeeLabel').textContent = T.fee + ' (' + room.fee_percent + '%)';
        $('dlgFee').textContent = room.fee_amount > 0 ? '-' + room.fee_amount : T.none;
        $('dlgPayout').textContent = room.payout;
        $('dlgBalance').textContent = room.balance;
        setBalance(room.balance);

        $('dlgJoin').disabled = false;
        $('dlgNote').style.display = '';
        $('dlgWarn').classList.remove('show');
        if (!room.enough) { showLowBalance(room.stake, room.balance); }

        $('ttDialog').classList.add('show');
    }

    function closeDialog() {
        $('ttDialog').classList.remove('show');
        S.pendingCode = null;
    }

    // Cancel: nothing is paid, the room's owner is told you said no.
    function dialogCancel() {
        var code = S.pendingCode;
        closeDialog();
        if (code) { api('POST', BASE + '/decline', { code: code }); }
        showScreen('ttJoin');
        showInfo(T.cancelled);
    }

    // Join Game: your points are taken and the match starts.
    function doJoin(code) {
        if (!code || S.busy) { return; }
        S.busy = true;
        clearMsg();
        $('dlgJoin').disabled = true;

        api('POST', BASE + '/join', { code: code }).then(function (r) {
            S.busy = false;
            if (r.ok && r.data.state) {
                closeDialog();
                S.mode = 'join';
                S.size = r.data.state.size;
                enterGame();
                renderMatch(r.data.state);
            } else if (r.status !== 401) {
                var low = r.data && r.data.low_balance;
                if (low && $('ttDialog').classList.contains('show')) {
                    showLowBalance(low.need, low.balance);   // keep the dialog: "add points" notice
                } else {
                    closeDialog();
                    showError(msgFrom(r));
                }
            }
        }).catch(function () {
            S.busy = false;
            $('dlgJoin').disabled = false;
            closeDialog();
            showError(T.network);
        });
    }

    function sendMove(i) {
        var st = S.match;
        if (!st || S.busy || st.status !== 'active' || st.turn !== st.you) { return; }
        if (st.board.charAt(i) !== '-') { return; }

        S.busy = true;

        // Show the player's mark straight away, the server confirms it.
        var optimistic = st.board.substr(0, i) + st.you + st.board.substr(i + 1);
        drawBoard(optimistic, [], i, false);
        if (st.mode === 'ai') { $('ttStatus').textContent = T.thinking; }

        api('POST', BASE + '/' + st.id + '/move', { cell: i }).then(function (r) {
            S.busy = false;
            if (r.data && r.data.state) {
                var ns = r.data.state;
                if (r.ok && typeof r.data.ai_cell === 'number') {
                    // Computer's answer appears after a short pause.
                    S.busy = true;
                    renderMatch(ns, r.data.ai_cell);
                    setTimeout(function () {
                        S.busy = false;
                        if (S.match && S.match.id === ns.id) { renderMatch(ns); }
                    }, 450);
                } else {
                    renderMatch(ns);
                    if (!r.ok && r.data.message) { showError(r.data.message); }
                }
            } else if (r.status === 404) {
                goMenu();
            } else if (r.status !== 401) {
                renderMatch(st);
                showError((r.data && r.data.message) || T.wrong);
            }
        }).catch(function () {
            S.busy = false;
            renderMatch(st);
            showError(T.network);
        });
    }

    function leaveMatch() {
        var st = S.match;
        if (S.mode === 'offline' || !st) { goMenu(); return; }

        if (st.status === 'active') {
            var question = (st.mode === 'online' && st.stake > 0) ? T.confirmLeavePts.replace(':amount', st.stake) : T.confirmLeave;
            if (!confirm(question)) { return; }
        }
        if (st.status === 'finished' || st.status === 'cancelled') { goMenu(); return; }

        stopTimers();
        api('POST', BASE + '/' + st.id + '/leave').then(function (r) {
            if (r.ok && r.data.state && typeof r.data.state.balance === 'number') { setBalance(r.data.state.balance); }
            goMenu();
        }).catch(function () { goMenu(); });
    }

    /* ---------------- offline: two players, one device ---------------- */

    function startOffline(size) {
        S.mode = 'offline';
        S.size = size;
        S.match = null;
        S.local = { size: size, winLen: WIN_LEN[size], board: new Array(size * size + 1).join('-'), turn: 'X', over: false, cells: [], last: null, result: null };
        enterGame();
        renderLocal();
    }

    function renderLocal() {
        var L = S.local;
        buildBoard(L.size);
        drawBoard(L.board, L.cells, L.last, !L.over);
        setChips(T.player1, T.player2, L.turn, L.over);
        $('ttCodeBox').classList.remove('show');
        $('ttRule').textContent = L.winLen + ' ' + T.inARow;
        $('ttTimer').textContent = '';
        $('ttLeaveText').textContent = L.over ? T.menu : T.menu;

        if (L.over) {
            $('ttStatus').textContent = '';
            $('ttAgain').style.display = '';
            if (L.result === 'draw') {
                showResultBox('lose', T.draw, T.offlineNote);
            } else {
                showResultBox('win', L.result === 'X' ? T.xWins : T.oWins, T.offlineNote);
            }
        } else {
            $('ttStatus').textContent = T.turnOf.replace(':name', L.turn === 'X' ? T.player1 : T.player2) + ' (' + L.turn + ')';
            $('ttAgain').style.display = 'none';
            hideResultBox();
        }
    }

    function localMove(i) {
        var L = S.local;
        if (!L || L.over || L.board.charAt(i) !== '-') { return; }
        L.board = L.board.substr(0, i) + L.turn + L.board.substr(i + 1);
        L.last = i;

        var e = evaluate(L.board, L.size, L.winLen);
        if (e.status === 'win') {
            L.over = true; L.result = e.symbol; L.cells = e.cells;
        } else if (e.status === 'draw') {
            L.over = true; L.result = 'draw'; L.cells = [];
        } else {
            L.turn = L.turn === 'X' ? 'O' : 'X';
        }
        renderLocal();
    }

    /* ---------------- wiring ---------------- */

    function updateStakeHint() {
        var t = FEE > 0 ? T.stakeHint.replace(':bal', S.balance).replace(':fee', FEE) : T.stakeHintNoFee.replace(':bal', S.balance);
        $('ttStakeHint').textContent = t;
    }

    function openGrid(forWhat) {
        S.gridFor = forWhat;
        var box = $('ttStakeBox');
        if (forWhat === 'create') {
            var inp = $('ttStake');
            if (!inp.value && S.lastStake) { inp.value = S.lastStake; }
            if (inp.value && parseInt(inp.value, 10) > S.balance) { inp.value = S.balance > 0 ? S.balance : ''; }
            inp.max = S.balance;
            updateStakeHint();
            box.classList.add('show');
        } else {
            box.classList.remove('show');
        }
        showScreen('ttGrid');
    }

    $('ttOnePlayer').addEventListener('click', function () {
        if (isGuest) { loginRedirect(); return; }
        openGrid('ai');
    });
    $('ttTwoPlayers').addEventListener('click', function () { showScreen('ttPlayers'); });
    $('ttOffline').addEventListener('click', function () { openGrid('offline'); });
    $('ttOnline').addEventListener('click', function () {
        if (isGuest) { loginRedirect(); return; }
        showScreen('ttOnlineMenu');
    });
    $('ttCreate').addEventListener('click', function () { openGrid('create'); });
    $('ttEnter').addEventListener('click', function () { showScreen('ttJoin'); $('ttJoinCode').focus(); });
    $('ttJoinBtn').addEventListener('click', findRoom);
    $('ttJoinCode').addEventListener('keydown', function (ev) { if (ev.key === 'Enter') { findRoom(); } });
    $('ttJoinCode').addEventListener('input', function () {
        this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
    });

    $('ttGridBack').addEventListener('click', function () {
        if (S.gridFor === 'ai') { showScreen('ttMenu'); }
        else if (S.gridFor === 'offline') { showScreen('ttPlayers'); }
        else { showScreen('ttOnlineMenu'); }
    });

    var backs = document.querySelectorAll('.js-back');
    for (var b = 0; b < backs.length; b++) {
        backs[b].addEventListener('click', function () { showScreen(this.getAttribute('data-to')); });
    }

    var gridBtns = document.querySelectorAll('.js-grid');
    for (var g = 0; g < gridBtns.length; g++) {
        gridBtns[g].addEventListener('click', function () {
            var size = parseInt(this.getAttribute('data-size'), 10);
            if (S.gridFor === 'ai') {
                startServerMatch('ai', size);
            } else if (S.gridFor === 'create') {
                var stake = parseInt($('ttStake').value, 10);
                if (!(stake >= 1)) { showError(T.stakeNeed); return; }
                if (stake > S.balance) { showError(T.stakeMore.replace(':amount', S.balance)); return; }
                S.lastStake = stake;
                startServerMatch('room', size, stake);
            } else {
                startOffline(size);
            }
        });
    }

    boardEl.addEventListener('click', function (ev) {
        var el = ev.target;
        while (el && el !== boardEl && !(el.classList && el.classList.contains('tt-cell'))) { el = el.parentNode; }
        if (!el || el === boardEl || el.disabled) { return; }
        var i = parseInt(el.getAttribute('data-i'), 10);
        if (S.mode === 'offline') { localMove(i); } else { sendMove(i); }
    });

    $('ttLeave').addEventListener('click', leaveMatch);

    $('ttAgain').addEventListener('click', function () {
        if (S.mode === 'offline') { startOffline(S.size); }
        else if (S.mode === 'ai') { startServerMatch('ai', S.size); }
        else if (S.mode === 'create') { goMenu(); openGrid('create'); }
        else { goMenu(); showScreen('ttJoin'); $('ttJoinCode').value = ''; $('ttJoinCode').focus(); }
    });

    $('ttCopy').addEventListener('click', function () {
        var code = $('ttCode').textContent;
        var btn = this;
        function done() {
            btn.textContent = T.copied;
            setTimeout(function () { btn.innerHTML = '<i class="far fa-copy"></i> ' + T.copy; }, 1500);
        }
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(code).then(done, done);
        } else {
            var ta = document.createElement('textarea');
            ta.value = code;
            document.body.appendChild(ta);
            ta.select();
            try { document.execCommand('copy'); } catch (e) {}
            document.body.removeChild(ta);
            done();
        }
    });

    $('ttStakeMax').addEventListener('click', function () {
        $('ttStake').value = S.balance > 0 ? S.balance : '';
    });
    $('ttNoticeX').addEventListener('click', hideNotice);
    $('dlgCancel').addEventListener('click', dialogCancel);
    $('dlgJoin').addEventListener('click', function () { doJoin(S.pendingCode); });

    if (!active) {
        $('ttOnePlayer').disabled = true;
        $('ttTwoPlayers').disabled = true;
        showError(T.unavailable);
    }

    /* ---- Came back to an unfinished match (refresh / closed tab): continue it ---- */
    if (activeMatchId && !isGuest) {
        api('GET', BASE + '/' + activeMatchId + '/state').then(function (r) {
            if (r.ok && r.data.state && (r.data.state.status === 'waiting' || r.data.state.status === 'active')) {
                var st = r.data.state;
                S.mode = st.mode === 'ai' ? 'ai' : (st.you === 'X' ? 'create' : 'join');
                S.size = st.size;
                enterGame();
                renderMatch(st);
            }
        });
    }
})();
</script>

@endsection
