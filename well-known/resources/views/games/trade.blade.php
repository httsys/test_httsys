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

    <div class="tr-wrap">
        <div class="tr-grid">

            <div class="tr-chart-col">
                <div class="tr-chart-top">
                    <span class="tr-pair">BTC/USD</span>
                    <span class="tr-live" id="trLive"></span>
                </div>
                <canvas id="trChart"></canvas>
                <div class="tr-status" id="trStatus"></div>
            </div>

            <div class="tr-side">
                <div class="tr-balance">
                    <span>{{ __('Trades left') }}: <b>{{ $remaining === null ? __('Unlimited') : $remaining }}</b></span>
                    <span>{{ __('Your points') }}: <b id="trPoints">{{ $isGuest ? __('—') : number_format($points) }}</b></span>
                </div>

                <div class="tr-result" id="trResult">
                    <div class="t" id="trResultTitle"></div>
                    <div class="s" id="trResultSub"></div>
                </div>

                <div class="tr-box">
                    <label for="trAmount">{{ __('Amount (points)') }}</label>
                    <div class="tr-amount">
                        <button type="button" id="trMinus" aria-label="minus">&minus;</button>
                        <input type="number" id="trAmount" inputmode="numeric" step="1" value="{{ max(1, (int) $setting->option('min_stake', 1)) }}">
                        <button type="button" id="trPlus" aria-label="plus">+</button>
                    </div>
                </div>

                <div class="tr-box">
                    <label for="trDuration">{{ __('Duration') }}</label>
                    <select id="trDuration">
                        @foreach (\App\Models\GameSetting::$tradeDurations as $secs => $label)
                            <option value="{{ $secs }}" {{ $secs === 30 ? 'selected' : '' }}>{{ __($label) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="tr-payout">
                    <div class="big">+{{ (int) $setting->option('payout_percent', 100) }}%</div>
                    <div class="sub" id="trProfit"></div>
                </div>

                <button type="button" class="tr-btn up js-dir" data-dir="up"><i class="fas fa-arrow-up"></i> {{ __('HIGHER') }}</button>
                <button type="button" class="tr-btn down js-dir" data-dir="down"><i class="fas fa-arrow-down"></i> {{ __('LOWER') }}</button>

                @if ($hasPending)
                    <div class="tr-msg note">{{ __('You have an unfinished trade. Press Higher or Lower to continue it.') }}</div>
                @endif
                <div class="tr-msg" id="trMsg"></div>

                <div class="tr-foot">{{ __('Guess where the price will be when the time is up. Right guess: you win the payout. Wrong guess: you lose the amount.') }}</div>
            </div>

        </div>
    </div>

    <div class="text-center mt-3">
        <a href="{{ route('games.index') }}" class="mg-points-pill"><i class="fas fa-arrow-left"></i> {{ __('All Mini Games') }}</a>
        @if ($isGuest)
            <a href="{{ route('login') }}?redirect_to={{ urlencode(url()->current()) }}" class="mg-points-pill"><i class="fas fa-sign-in-alt"></i> {{ __('Login to play') }}</a>
        @else
            <a href="{{ route('profile.show') }}#points" class="mg-points-pill"><i class="fas fa-coins"></i> {{ __('My Points') }}</a>
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
    var minStake = @json(max(1, (int) $setting->option('min_stake', 1)));
    var maxStake = @json(max(1, (int) $setting->option('max_stake', 100)));
    var payout = @json(max(0, (int) $setting->option('payout_percent', 100)));
    var balance = @json($isGuest ? 0 : (int) $points);   // while a result is being replayed this is the balance from before the trade

    var tokenMeta = document.querySelector('meta[name="csrf-token"]');
    var token = tokenMeta ? tokenMeta.getAttribute('content') : '';

    var cv = document.getElementById('trChart');
    var ctx = cv.getContext('2d');
    var amountEl = document.getElementById('trAmount');
    var durationEl = document.getElementById('trDuration');
    var profitEl = document.getElementById('trProfit');
    var msgEl = document.getElementById('trMsg');
    var statusEl = document.getElementById('trStatus');
    var liveEl = document.getElementById('trLive');
    var pointsEl = document.getElementById('trPoints');
    var resultEl = document.getElementById('trResult');
    var dirButtons = document.querySelectorAll('.js-dir');
    var busy = false;      // a request or a replay is in progress

    /* ---------- helpers ---------- */
    function mulberry32(a) {
        return function () {
            a |= 0; a = a + 0x6D2B79F5 | 0;
            var t = Math.imul(a ^ a >>> 15, 1 | a);
            t = t + Math.imul(t ^ t >>> 7, 61 | t) ^ t;
            return ((t ^ t >>> 14) >>> 0) / 4294967296;
        };
    }

    function money(v) {
        return v.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function clock(sec) {
        sec = Math.max(0, Math.ceil(sec));
        var m = Math.floor(sec / 60), s = sec % 60;
        return (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s;
    }

    function maxAllowed() { return Math.max(0, Math.min(maxStake, balance)); }

    function readAmount() {
        var n = parseInt(amountEl.value, 10);
        return isNaN(n) ? 0 : n;
    }

    function clampAmount() {
        var top = Math.max(minStake, maxAllowed());
        var n = readAmount();
        if (n < minStake) { n = minStake; }
        if (n > top) { n = top; }
        amountEl.value = n;
        return n;
    }

    function updateProfit() {
        var n = readAmount();
        var gain = Math.max(1, Math.round(n * payout / 100));
        profitEl.textContent = '+' + gain + ' ' + (gain === 1 ? @json(__('point')) : @json(__('points')));
    }

    function showError(text) {
        msgEl.textContent = text;
        msgEl.className = 'tr-msg error';
    }

    function setBalance(v) {
        balance = v;
        pointsEl.textContent = Number(v).toLocaleString();
    }

    function setDirButtons(disabled) {
        for (var i = 0; i < dirButtons.length; i++) { dirButtons[i].disabled = disabled; }
    }

    function refreshControls() {
        busy = false;
        msgEl.className = 'tr-msg';

        if (isGuest) {
            setDirButtons(false); // let them click through to the login page
        } else if (!active) {
            setDirButtons(true);
            showError(@json(__('This game is currently unavailable.')));
        } else if (remaining !== null && remaining <= 0 && !hasPending) {
            setDirButtons(true);
            showError(@json(__('You have used all your trades for this hour. Please come back later.')));
        } else if (balance < minStake) {
            setDirButtons(true);
            showError(@json(__('You need more points to trade. Win points in the other mini games first.')));
        } else {
            setDirButtons(false);
            clampAmount();
        }
        updateProfit();
    }

    /* ---------- chart drawing ---------- */
    var dpr = window.devicePixelRatio || 1;

    function draw(series, entry) {
        var W = cv.clientWidth, H = cv.clientHeight;
        if (cv.width !== Math.round(W * dpr) || cv.height !== Math.round(H * dpr)) {
            cv.width = Math.round(W * dpr);
            cv.height = Math.round(H * dpr);
        }
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
        ctx.clearRect(0, 0, W, H);

        var padL = 6, padR = 92, padT = 56, padB = 26;
        var min = Infinity, max = -Infinity, i;
        for (i = 0; i < series.length; i++) {
            if (series[i] < min) { min = series[i]; }
            if (series[i] > max) { max = series[i]; }
        }
        if (entry !== null) { min = Math.min(min, entry); max = Math.max(max, entry); }
        var span = (max - min) || 1;
        min -= span * 0.1; max += span * 0.1;

        function X(idx) { return padL + idx * (W - padL - padR) / Math.max(1, series.length - 1); }
        function Y(v) { return padT + (max - v) * (H - padT - padB) / (max - min); }

        // grid + price labels
        ctx.font = '12px Arial, sans-serif';
        ctx.textAlign = 'left';
        ctx.textBaseline = 'middle';
        for (i = 0; i <= 5; i++) {
            var gv = min + (max - min) * i / 5;
            var gy = Y(gv);
            ctx.strokeStyle = 'rgba(255,255,255,0.06)';
            ctx.lineWidth = 1;
            ctx.beginPath(); ctx.moveTo(padL, gy); ctx.lineTo(W - padR, gy); ctx.stroke();
            ctx.fillStyle = '#9aa6b2';
            ctx.fillText(Math.round(gv).toLocaleString(), W - padR + 8, gy);
        }

        // area
        var grad = ctx.createLinearGradient(0, padT, 0, H - padB);
        grad.addColorStop(0, 'rgba(0,181,255,0.45)');
        grad.addColorStop(1, 'rgba(0,181,255,0.02)');
        ctx.beginPath();
        ctx.moveTo(X(0), H - padB);
        for (i = 0; i < series.length; i++) { ctx.lineTo(X(i), Y(series[i])); }
        ctx.lineTo(X(series.length - 1), H - padB);
        ctx.closePath();
        ctx.fillStyle = grad;
        ctx.fill();

        // line
        ctx.beginPath();
        for (i = 0; i < series.length; i++) {
            if (i === 0) { ctx.moveTo(X(i), Y(series[i])); } else { ctx.lineTo(X(i), Y(series[i])); }
        }
        ctx.strokeStyle = '#00b5ff';
        ctx.lineWidth = 1.6;
        ctx.lineJoin = 'round';
        ctx.stroke();

        // entry line (trade in progress)
        if (entry !== null) {
            var ey = Y(entry);
            ctx.setLineDash([3, 4]);
            ctx.strokeStyle = 'rgba(255,255,255,0.75)';
            ctx.lineWidth = 1;
            ctx.beginPath(); ctx.moveTo(padL, ey); ctx.lineTo(W - padR, ey); ctx.stroke();
            ctx.setLineDash([]);
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(W - padR + 2, ey - 10, padR - 4, 20);
            ctx.fillStyle = '#111';
            ctx.fillText(money(entry), W - padR + 6, ey);
        }

        // last point + label
        var last = series[series.length - 1];
        var lx = X(series.length - 1), ly = Y(last);
        ctx.fillStyle = '#00b5ff';
        ctx.beginPath(); ctx.arc(lx, ly, 4, 0, Math.PI * 2); ctx.fill();
        ctx.fillStyle = '#00b5ff';
        ctx.fillRect(W - padR + 2, ly - 10, padR - 4, 20);
        ctx.fillStyle = '#111';
        ctx.fillText(money(last), W - padR + 6, ly);

        liveEl.textContent = money(last);
    }

    /* ---------- idle chart (just for show while choosing) ---------- */
    var idleSeries = [];
    var idleTimer = null;

    function startIdle() {
        var v = 80000 + Math.random() * 1500;
        idleSeries = [];
        for (var i = 0; i < 200; i++) {
            v += (Math.random() - 0.5) * 60;
            idleSeries.push(v);
        }
        draw(idleSeries, null);
        idleTimer = setInterval(function () {
            var last = idleSeries[idleSeries.length - 1];
            idleSeries.push(last + (Math.random() - 0.5) * 60);
            idleSeries.shift();
            draw(idleSeries, null);
        }, 300);
    }

    function stopIdle() {
        if (idleTimer) { clearInterval(idleTimer); idleTimer = null; }
    }

    /* ---------- the trade replay (same path for the same play id) ---------- */
    function buildTrade(seed, seconds, finalUp) {
        var rng = mulberry32(seed * 7919 + 13);
        var entry = 78000 + rng() * 4000;
        var HIST = 120, N = Math.max(40, seconds * 4), i;

        var hist = [], v = 0;
        for (i = 0; i < HIST; i++) { v += (rng() - 0.5) * 55; hist.push(v); }
        var shift = hist[HIST - 1];
        for (i = 0; i < HIST; i++) { hist[i] = entry + (hist[i] - shift); }

        var w = [0];
        for (i = 1; i <= N; i++) { w.push(w[i - 1] + (rng() - 0.5) * 45); }
        var target = (finalUp ? 1 : -1) * (30 + rng() * 110);

        var path = [];
        for (i = 0; i <= N; i++) {
            path.push(entry + (w[i] - (i / N) * w[N]) + (i / N) * target);
        }
        return { entry: entry, hist: hist, path: path, steps: N };
    }

    function playTrade(r) {
        busy = true;
        stopIdle();
        setDirButtons(true);

        var seconds = r.seconds > 0 ? r.seconds : 30;
        var data = buildTrade(r.seed, seconds, r.outcome === 'up');
        var startedAt = Date.now() - r.elapsed * 1000;
        var label = (r.direction === 'up' ? @json(__('HIGHER')) : @json(__('LOWER'))) + ' · ' + r.stake + ' ' + @json(__('pts'));

        statusEl.className = 'tr-status show';

        var lastSeries = null;

        var loop = setInterval(function () {
            var elapsed = (Date.now() - startedAt) / 1000;
            var idx = Math.min(data.steps, Math.floor(elapsed / seconds * data.steps));
            var series = data.hist.concat(data.path.slice(0, idx + 1)).slice(-240);
            lastSeries = series;
            draw(series, data.entry);

            var now = data.path[idx];
            var diff = now - data.entry;
            statusEl.innerHTML = label + ' &nbsp;|&nbsp; ' + @json(__('Time left')) + ' <b>' + clock(seconds - elapsed) + '</b> &nbsp;|&nbsp; ' + (diff >= 0 ? '&#9650; +' : '&#9660; ') + money(diff);

            if (idx >= data.steps) {
                clearInterval(loop);
                finishTrade(r, lastSeries);
            }
        }, 100);
    }

    function finishTrade(r, lastSeries) {
        resultEl.className = 'tr-result show ' + (r.win ? 'win' : 'lose');
        var moved = r.outcome === 'up' ? @json(__('The price finished higher.')) : @json(__('The price finished lower.'));
        if (r.win) {
            document.getElementById('trResultTitle').textContent = @json(__('You won!'));
            document.getElementById('trResultSub').textContent = moved + ' +' + r.change + ' ' + (r.change === 1 ? @json(__('point')) : @json(__('points'))) + '.';
        } else {
            var lost = Math.abs(r.change);
            document.getElementById('trResultTitle').textContent = @json(__('Better luck next time'));
            document.getElementById('trResultSub').textContent = moved + ' -' + lost + ' ' + (lost === 1 ? @json(__('point')) : @json(__('points'))) + '.';
        }
        statusEl.className = 'tr-status';
        setBalance(r.balance);
        // The ?play=... link is dropped only now, so a refresh in the middle of a trade resumes it.
        if (window.history && window.history.replaceState) {
            window.history.replaceState(null, '', window.location.pathname);
        }
        refreshControls();
        // The chart keeps moving after the result too, exactly like before a trade starts.
        continueLive(lastSeries || [data0()]);
    }

    function data0() {
        return 80000 + Math.random() * 1500;
    }

    /**
     * Resume the idle animation continuing on from wherever the chart just
     * was (an entry price line, a finished trade), instead of jumping to a
     * brand new random price.
     */
    function continueLive(fromSeries) {
        idleSeries = (fromSeries || []).slice(-200);
        while (idleSeries.length < 60) {
            var seed = idleSeries.length ? idleSeries[idleSeries.length - 1] : data0();
            idleSeries.push(seed + (Math.random() - 0.5) * 60);
        }
        draw(idleSeries, null);
        if (idleTimer) { clearInterval(idleTimer); }
        idleTimer = setInterval(function () {
            var last = idleSeries[idleSeries.length - 1];
            idleSeries.push(last + (Math.random() - 0.5) * 60);
            idleSeries.shift();
            draw(idleSeries, null);
        }, 300);
    }

    /* ---------- controls ---------- */
    document.getElementById('trMinus').addEventListener('click', function () {
        amountEl.value = Math.max(minStake, readAmount() - 1);
        clampAmount(); updateProfit();
    });
    document.getElementById('trPlus').addEventListener('click', function () {
        amountEl.value = readAmount() + 1;
        clampAmount(); updateProfit();
    });
    amountEl.addEventListener('input', updateProfit);
    amountEl.addEventListener('change', function () { clampAmount(); updateProfit(); });

    function startTrade(direction) {
        if (busy) { return; }
        if (isGuest) { loginRedirect(); return; }
        var stake = clampAmount();
        if (stake < minStake || stake > balance) {
            showError(@json(__('You do not have enough points for this amount.')));
            return;
        }

        busy = true;
        setDirButtons(true);
        msgEl.className = 'tr-msg';

        fetch(startUrl, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ direction: direction, stake: stake, seconds: parseInt(durationEl.value, 10) })
        }).then(function (res) {
            if (res.status === 401) { loginRedirect(); return null; }
            return res.json().then(function (data) { return { ok: res.ok, data: data }; });
        }).then(function (r) {
            if (!r) { return; }
            if (r.ok && r.data.redirect) {
                window.location.href = r.data.redirect;
            } else {
                showError(r.data.message || @json(__('Something went wrong. Please try again.')));
                busy = false;
                setDirButtons(false);
            }
        }).catch(function () {
            showError(@json(__('Network error. Please try again.')));
            busy = false;
            setDirButtons(false);
        });
    }

    for (var b = 0; b < dirButtons.length; b++) {
        dirButtons[b].addEventListener('click', function () { startTrade(this.getAttribute('data-dir')); });
    }

    window.addEventListener('resize', function () {
        if (idleTimer) { draw(idleSeries, null); }
    });

    /* ---------- go ---------- */
    updateProfit();
    if (result && result.seconds > 0) {
        playTrade(result);
    } else {
        startIdle();
        refreshControls();
    }
})();
</script>

@endsection
