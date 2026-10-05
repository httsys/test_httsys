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
            <div class="mg-icon" style="background: rgba(0,181,255,.18); color:#00b5ff;"><i class="fas fa-dice"></i></div>
            <h3>{{ $game['name'] }}</h3>
            <p>{{ __($game['tagline']) }}</p>
        </div>

        <div class="mg-panel-body">
            <div class="mg-left-bar">
                <i class="far fa-dot-circle"></i> {{ __('Spins Left') }}:
                <span style="color:#00b5ff;">{{ $remaining === null ? __('Unlimited') : $remaining }}</span>
            </div>

            <div class="mg-result" id="mgResult">
                <div class="mg-result-title" id="mgResultTitle"></div>
                <div class="mg-result-sub" id="mgResultSub"></div>
            </div>

            <div class="sl-title">3 Numbers</div>
            <div class="sl-machine">
                <div class="sl-window" id="slWindow">
                    @for ($r = 0; $r < 3; $r++)
                        <div class="sl-reel"><div class="sl-strip"></div></div>
                    @endfor
                </div>
            </div>
            <div class="sl-prize" id="slPrize"></div>

            <button type="button" class="mg-btn" id="mgSpinBtn"><i class="fas fa-sync-alt"></i> {{ __('SPIN TO EARN') }}</button>

            @if ($hasPending)
                <div class="mg-msg" style="display:block; background:rgba(0,120,255,.22); color:#8fd6ff;">{{ __('You have an unfinished spin. Press the button to continue it.') }}</div>
            @endif
            <div class="mg-msg" id="mgMsg"></div>
        </div>

        <div class="mg-panel-foot"><i class="far fa-question-circle"></i> {{ __('The 3-digit number you land on is the number of points you win. 100 = 100 points, 001 = 1 point.') }}</div>
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

    var btn = document.getElementById('mgSpinBtn');
    var msg = document.getElementById('mgMsg');
    var resultBox = document.getElementById('mgResult');
    var prizeEl = document.getElementById('slPrize');
    var strips = document.querySelectorAll('.sl-strip');

    /* Each reel is a tall strip of digits 0-9 repeated 8 times. */
    var CYCLES = 8;
    for (var r = 0; r < strips.length; r++) {
        var html = '';
        for (var c = 0; c < CYCLES; c++) {
            for (var d = 0; d < 10; d++) { html += '<div class="sl-d">' + d + '</div>'; }
        }
        strips[r].innerHTML = html;
    }

    function rowHeight() {
        var first = document.querySelector('.sl-d');
        return first ? first.offsetHeight : 108;
    }

    function spinTo(numberText, done) {
        var h = rowHeight();
        var digits = String(numberText).split('');
        for (var i = 0; i < strips.length; i++) {
            var digit = parseInt(digits[i], 10) || 0;
            var offset = (5 * 10 + digit) * h;
            strips[i].getBoundingClientRect();
            strips[i].style.transition = 'transform ' + (2.4 + i * 0.8) + 's cubic-bezier(.15,.75,.2,1)';
            strips[i].style.transform = 'translateY(-' + offset + 'px)';
        }
        window.setTimeout(done, 2400 + 2 * 800 + 300);
    }

    function showError(text) {
        msg.textContent = text;
        msg.className = 'mg-msg error';
    }

    function showResult(r) {
        var points = parseInt(r.outcome, 10) || 0;
        resultBox.className = 'mg-result show ' + (r.win ? 'win' : 'lose');
        document.getElementById('mgResultTitle').textContent = r.win ? @json(__('You won!')) : @json(__('Better luck next time'));
        document.getElementById('mgResultSub').textContent = r.win
            ? ('+' + r.points + ' ' + (r.points === 1 ? @json(__('point')) : @json(__('points'))) + ' ' + @json(__('added to your account.')))
            : @json(__('000 - no points this time. Try again!'));
        prizeEl.textContent = r.win ? ('+' + r.points) : '';
        document.getElementById('mgPoints').textContent = Number(r.balance).toLocaleString();
    }

    function refreshButton() {
        if (!active) {
            btn.disabled = true;
            showError(@json(__('This game is currently unavailable.')));
        } else if (remaining !== null && remaining <= 0 && !hasPending) {
            btn.disabled = true;
            showError(@json(__('You have used all your spins for this hour. Please come back later.')));
        } else {
            btn.disabled = false;
        }
    }

    btn.addEventListener('click', function () {
        if (btn.disabled) { return; }
        if (isGuest) { loginRedirect(); return; }
        btn.disabled = true;
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
            body: JSON.stringify({})
        }).then(function (res) {
            if (res.status === 401) { loginRedirect(); return null; }
            return res.json().then(function (data) { return { ok: res.ok, data: data }; });
        }).then(function (r) {
            if (!r) { return; }
            if (r.ok && r.data.redirect) {
                window.location.href = r.data.redirect;
            } else {
                showError(r.data.message || @json(__('Something went wrong. Please try again.')));
                btn.disabled = false;
            }
        }).catch(function () {
            showError(@json(__('Network error. Please try again.')));
            btn.disabled = false;
        });
    });

    if (result) {
        btn.disabled = true;
        if (window.history && window.history.replaceState) {
            window.history.replaceState(null, '', window.location.pathname);
        }
        window.setTimeout(function () {
            spinTo(result.outcome || '000', function () {
                showResult(result);
                refreshButton();
            });
        }, 500);
    } else {
        refreshButton();
    }
})();
</script>

@endsection
