@extends('layouts.front')

@section('title') {{ $game['name'] }} @endsection
@section('meta') {{ $game['tagline'] }} @endsection

@section('content')

@include('games._styles')

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
            <div class="mg-icon" style="background: rgba(0,181,255,.18); color:#00b5ff;"><i class="fas fa-coins"></i></div>
            <h3>{{ $game['name'] }}</h3>
            <p>{{ __($game['tagline']) }}</p>
        </div>

        <div class="mg-panel-body">
            <div class="mg-left-bar">
                <i class="far fa-dot-circle"></i> {{ __('Flips Left') }}:
                <span style="color:#00b5ff;">{{ $remaining === null ? __('Unlimited') : $remaining }}</span>
            </div>

            <div class="mg-result" id="mgResult">
                <div class="mg-result-title" id="mgResultTitle"></div>
                <div class="mg-result-sub" id="mgResultSub"></div>
            </div>

            <div class="mg-coin-stage">
                <div class="mg-coin" id="mgCoin">
                    <div class="face heads"><div class="big">H</div><div class="small">{{ __('HEADS') }}</div></div>
                    <div class="face tails"><div class="big">T</div><div class="small">{{ __('TAILS') }}</div></div>
                </div>
            </div>

            <p class="mg-choose">{{ __('CHOOSE A SIDE') }}</p>
            <div class="mg-choice-row">
                <button type="button" class="mg-btn js-choice" data-choice="heads"><i class="far fa-circle"></i> {{ __('HEADS') }}</button>
                <button type="button" class="mg-btn teal js-choice" data-choice="tails"><i class="far fa-star"></i> {{ __('TAILS') }}</button>
            </div>

            @if ($hasPending)
                <div class="mg-msg" style="display:block; background:rgba(0,120,255,.22); color:#8fd6ff;">{{ __('You have an unfinished flip. Pick a side to continue it.') }}</div>
            @endif
            <div class="mg-msg" id="mgMsg"></div>
        </div>

        <div class="mg-panel-foot"><i class="far fa-question-circle"></i> {{ __('Guess correctly to win points!') }}</div>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('games.index') }}" class="mg-points-pill"><i class="fas fa-arrow-left"></i> {{ __('All Mini Games') }}</a>
        @if ($isGuest)
            <a href="{{ route('login') }}?redirect_to={{ urlencode(url()->current()) }}" class="mg-points-pill"><i class="fas fa-sign-in-alt"></i> {{ __('Login to play') }}</a>
        @else
            <a href="{{ route('profile.show') }}#points" class="mg-points-pill"><i class="fas fa-coins"></i> {{ __('My Points') }}: <span id="mgPoints">{{ number_format($points) }}</span></a>
        @endif
    </div>

</div>
</div>

<script>
(function () {
    var startUrl = @json(route('games.start', $game['slug']));
    var result = @json($result);
    var remaining = @json($remaining);
    var active = @json((bool) $setting->is_active);
    var hasPending = @json((bool) $hasPending);
    var isGuest = @json((bool) $isGuest);
    var loginUrl = @json(route('login'));
    var loginRedirect = function () { window.location.href = loginUrl + '?redirect_to=' + encodeURIComponent(window.location.href); };

    var tokenMeta = document.querySelector('meta[name="csrf-token"]');
    var token = tokenMeta ? tokenMeta.getAttribute('content') : '';

    var buttons = document.querySelectorAll('.js-choice');
    var msg = document.getElementById('mgMsg');
    var coin = document.getElementById('mgCoin');
    var resultBox = document.getElementById('mgResult');

    function setButtons(disabled) {
        for (var i = 0; i < buttons.length; i++) { buttons[i].disabled = disabled; }
    }

    function showError(text) {
        msg.textContent = text;
        msg.className = 'mg-msg error';
    }

    function sideLabel(side) {
        return side === 'heads' ? @json(__('HEADS')) : @json(__('TAILS'));
    }

    function flipTo(side, done) {
        // 5 full turns, plus half a turn more when it should land on tails.
        var deg = 360 * 5 + (side === 'tails' ? 180 : 0);
        coin.getBoundingClientRect();
        coin.style.transition = 'transform 2.8s cubic-bezier(.2,.7,.2,1)';
        coin.style.transform = 'rotateY(' + deg + 'deg)';
        window.setTimeout(done, 3000);
    }

    function showResult(r) {
        resultBox.className = 'mg-result show ' + (r.win ? 'win' : 'lose');
        document.getElementById('mgResultTitle').textContent = r.win ? @json(__('You won!')) : @json(__('Better luck next time'));

        var landed = @json(__('It landed on')) + ' ' + sideLabel(r.outcome) + '. ';
        if (r.win) {
            document.getElementById('mgResultSub').textContent = landed + @json(__('You guessed right!')) + ' +' + r.points + ' ' + (r.points === 1 ? @json(__('point')) : @json(__('points'))) + '.';
        } else {
            document.getElementById('mgResultSub').textContent = landed + @json(__('You picked')) + ' ' + sideLabel(r.choice) + '.';
        }
        document.getElementById('mgPoints').textContent = Number(r.balance).toLocaleString();
    }

    function refreshButtons() {
        if (!active) {
            setButtons(true);
            showError(@json(__('This game is currently unavailable.')));
        } else if (remaining !== null && remaining <= 0 && !hasPending) {
            setButtons(true);
            showError(@json(__('You have used all your flips for this hour. Please come back later.')));
        } else {
            setButtons(false);
        }
    }

    function start(choice) {
        if (isGuest) { loginRedirect(); return; }
        setButtons(true);
        msg.className = 'mg-msg';

        fetch(startUrl, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ choice: choice })
        }).then(function (res) {
            if (res.status === 401) { loginRedirect(); return null; }
            return res.json().then(function (data) { return { ok: res.ok, data: data }; });
        }).then(function (r) {
            if (!r) { return; }
            if (r.ok && r.data.redirect) {
                window.location.href = r.data.redirect;
            } else {
                showError(r.data.message || @json(__('Something went wrong. Please try again.')));
                setButtons(false);
            }
        }).catch(function () {
            showError(@json(__('Network error. Please try again.')));
            setButtons(false);
        });
    }

    for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', function () {
            if (this.disabled) { return; }
            start(this.getAttribute('data-choice'));
        });
    }

    /* ---- Arriving from a finished play: reveal the result ---- */
    if (result) {
        setButtons(true);
        // Drop ?play=... so a refresh shows the plain coin instead of replaying.
        if (window.history && window.history.replaceState) {
            window.history.replaceState(null, '', window.location.pathname);
        }
        window.setTimeout(function () {
            flipTo(result.outcome, function () {
                showResult(result);
                refreshButtons();
            });
        }, 500);
    } else {
        refreshButtons();
    }
})();
</script>

@endsection
