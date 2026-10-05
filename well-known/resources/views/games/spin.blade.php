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
            <div class="mg-icon"><i class="fas fa-sync-alt"></i></div>
            <h3>{{ $game['name'] }}</h3>
            <p>{{ __($game['tagline']) }}</p>
        </div>

        <div class="mg-panel-body">
            <div class="mg-left-bar">
                <i class="far fa-dot-circle"></i> {{ __('Spins Left') }}:
                <span>{{ $remaining === null ? __('Unlimited') : $remaining }}</span>
            </div>

            <div class="mg-result" id="mgResult">
                <div class="mg-result-title" id="mgResultTitle"></div>
                <div class="mg-result-sub" id="mgResultSub"></div>
            </div>

            <div class="mg-wheel-stage">
                <div class="mg-wheel-pointer"></div>
                <div class="mg-wheel"><svg id="mgWheelSvg" viewBox="-150 -150 300 300" xmlns="http://www.w3.org/2000/svg"></svg></div>
                <div class="mg-wheel-hub"><i>$</i></div>
            </div>

            <button type="button" class="mg-btn" id="mgSpinBtn"><i class="fas fa-sync-alt"></i> {{ __('SPIN TO EARN') }}</button>

            @if ($hasPending)
                <div class="mg-msg" style="display:block; background:rgba(0,120,255,.22); color:#8fd6ff;">{{ __('You have an unfinished spin. Press the button to continue it.') }}</div>
            @endif
            <div class="mg-msg" id="mgMsg"></div>
        </div>

        <div class="mg-panel-foot"><i class="far fa-question-circle"></i> {{ __('Spin the wheel and land on a segment to win points!') }}</div>
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
    var pointsPerWin = @json((int) $setting->points_per_win);

    var tokenMeta = document.querySelector('meta[name="csrf-token"]');
    var token = tokenMeta ? tokenMeta.getAttribute('content') : '';

    var btn = document.getElementById('mgSpinBtn');
    var msg = document.getElementById('mgMsg');
    var svg = document.getElementById('mgWheelSvg');
    var resultBox = document.getElementById('mgResult');

    /* ---- Build the wheel: even segments are win, odd segments are lose ---- */
    var SEGMENTS = 10;
    var SEG_DEG = 360 / SEGMENTS;
    var colors = ['#0078ff', '#00b5ff', '#ff2e57', '#00b5ff', '#0078ff', '#00b5ff', '#ff2e57', '#00b5ff', '#0078ff', '#ff2e57'];
    var NS = 'http://www.w3.org/2000/svg';

    function point(radius, deg) {
        var rad = deg * Math.PI / 180;
        return [(radius * Math.sin(rad)).toFixed(2), (-radius * Math.cos(rad)).toFixed(2)];
    }

    for (var i = 0; i < SEGMENTS; i++) {
        var a0 = i * SEG_DEG, a1 = (i + 1) * SEG_DEG;
        var p0 = point(150, a0), p1 = point(150, a1);

        var path = document.createElementNS(NS, 'path');
        path.setAttribute('d', 'M0,0 L' + p0[0] + ',' + p0[1] + ' A150,150 0 0,1 ' + p1[0] + ',' + p1[1] + ' Z');
        path.setAttribute('fill', colors[i]);
        path.setAttribute('stroke', '#151824');
        path.setAttribute('stroke-width', '1.5');
        svg.appendChild(path);

        var label = document.createElementNS(NS, 'text');
        label.setAttribute('transform', 'rotate(' + (a0 + SEG_DEG / 2) + ') translate(0,-108)');
        label.setAttribute('text-anchor', 'middle');
        label.setAttribute('fill', '#ffffff');
        label.setAttribute('font-size', '22');
        label.setAttribute('font-weight', '800');
        label.textContent = (i % 2 === 0) ? ('+' + pointsPerWin) : '0';
        svg.appendChild(label);
    }

    function spinTo(win, done) {
        var candidates = [];
        for (var k = 0; k < SEGMENTS; k++) {
            if ((k % 2 === 0) === win) { candidates.push(k); }
        }
        var idx = candidates[Math.floor(Math.random() * candidates.length)];
        var center = idx * SEG_DEG + SEG_DEG / 2;
        var jitter = (Math.random() - 0.5) * (SEG_DEG - 10);
        var finalDeg = 360 * 6 + (360 - center) + jitter;

        svg.getBoundingClientRect();
        svg.style.transition = 'transform 5s cubic-bezier(.15,.6,.1,1)';
        svg.style.transform = 'rotate(' + finalDeg + 'deg)';

        window.setTimeout(done, 5250);
    }

    function showError(text) {
        msg.textContent = text;
        msg.className = 'mg-msg error';
    }

    function showResult(r) {
        resultBox.className = 'mg-result show ' + (r.win ? 'win' : 'lose');
        document.getElementById('mgResultTitle').textContent = r.win ? @json(__('You won!')) : @json(__('Better luck next time'));
        document.getElementById('mgResultSub').textContent = r.win
            ? ('+' + r.points + ' ' + (r.points === 1 ? @json(__('point')) : @json(__('points'))) + ' ' + @json(__('added to your account.')))
            : @json(__('No points this time. Try again!'));
        document.getElementById('mgPoints').textContent = Number(r.balance).toLocaleString();
    }

    /* ---- Button state ---- */
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

    /* ---- Start a play: go to the advertisement page ---- */
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

    /* ---- Arriving from a finished play: reveal the result ---- */
    if (result) {
        btn.disabled = true;
        // Drop ?play=... so a refresh shows the plain wheel instead of replaying.
        if (window.history && window.history.replaceState) {
            window.history.replaceState(null, '', window.location.pathname);
        }
        window.setTimeout(function () {
            spinTo(!!result.win, function () {
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
