<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ __('Advertisement') }} - {{ $game['name'] }}</title>

    {{-- Defined before the ad starts loading so a very fast load event is never missed. --}}
    <script>
        window.__adLoadedFlag = false;
        window.__adStart = null;
        window.__adLoaded = function () {
            window.__adLoadedFlag = true;
            if (window.__adStart) { window.__adStart(); }
        };
    </script>

    <style>
        * { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }
        body { display: flex; flex-direction: column; background: #0f1220; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; color: #fff; }

        .bar { flex: 0 0 auto; display: flex; align-items: center; gap: 18px; flex-wrap: wrap; padding: 10px 16px; background: #1e2230; border-bottom: 1px solid rgba(255,255,255,.08); }
        .bar .title { font-weight: 800; font-size: 15px; margin-right: auto; }
        .bar .title small { display: block; font-weight: 600; font-size: 11px; color: #9aa3b8; letter-spacing: .5px; text-transform: uppercase; }

        .count { display: flex; align-items: center; gap: 10px; }
        .ring { position: relative; width: 52px; height: 52px; }
        .ring svg { width: 100%; height: 100%; transform: rotate(-90deg); }
        .ring .bg { fill: none; stroke: rgba(255,255,255,.12); stroke-width: 5; }
        .ring .fg { fill: none; stroke: #00b5ff; stroke-width: 5; stroke-linecap: round; transition: stroke-dashoffset .3s linear; }
        .ring .num { position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 18px; }
        .count .txt { font-size: 13px; color: #cbd5e1; max-width: 150px; line-height: 1.3; }

        .math { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; background: #262b3a; border-radius: 10px; padding: 8px 12px; min-height: 52px; }
        .math .placeholder { font-size: 13px; color: #8f97ad; }
        .math .q { font-size: 20px; font-weight: 800; white-space: nowrap; }
        .math input { width: 90px; padding: 9px 10px; border: 2px solid #3b4256; border-radius: 8px; background: #151824; color: #fff; font-size: 18px; font-weight: 700; text-align: center; outline: none; }
        .math input:focus { border-color: #00b5ff; }
        .math button { border: 0; border-radius: 8px; padding: 10px 18px; background: #0078ff; color: #fff; font-weight: 800; font-size: 14px; cursor: pointer; }
        .math button:hover { background: #0062d1; }
        .math button[disabled] { opacity: .55; cursor: not-allowed; }
        .math .err { flex-basis: 100%; font-size: 12px; color: #ff9fb3; font-weight: 600; }
        .math .ok { flex-basis: 100%; font-size: 13px; color: #7fd8ff; font-weight: 700; }

        .back { color: #9aa3b8; font-size: 12px; text-decoration: none; }
        .back:hover { color: #fff; }

        .stage { flex: 1 1 auto; position: relative; background: #fff; min-height: 200px; }
        .stage iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0; background: #fff; }
        .stage .center { position: absolute; top: 0; left: 0; right: 0; bottom: 0; overflow: auto; display: flex; align-items: center; justify-content: center; background: #f4f6fa; color: #333; text-align: center; padding: 16px; }
        .stage .center img { max-width: 100%; max-height: 100%; display: block; }
        .stage .hint { position: absolute; left: 0; right: 0; bottom: 0; text-align: center; background: rgba(15,18,32,.78); color: #cbd5e1; font-size: 12px; padding: 6px 10px; }
        .stage .hint a { color: #8fd6ff; }

        .math.empty .q, .math.empty input, .math.empty button { display: none; }

        /* Phones: keep the dark top bar as small as possible so the advertisement gets the screen */
        @media (max-width: 640px) {
            .bar { gap: 6px 10px; padding: 6px 10px; }
            .bar .title { display: none; }
            .count { flex: 1 1 auto; min-width: 0; gap: 8px; }
            .ring { width: 36px; height: 36px; flex: 0 0 36px; }
            .ring .bg, .ring .fg { stroke-width: 6; }
            .ring .num { font-size: 13px; }
            .count .txt { font-size: 11px; line-height: 1.25; max-width: none; }
            .back { order: 2; font-size: 11px; padding: 6px 4px; }
            .math { order: 3; flex-basis: 100%; padding: 5px 8px; min-height: 0; gap: 8px; border-radius: 8px; }
            .math.empty { display: none; }
            .math .q { font-size: 16px; }
            .math input { width: 70px; padding: 6px 6px; font-size: 15px; border-width: 1.5px; }
            .math button { padding: 7px 12px; font-size: 13px; }
            .math .err, .math .ok { font-size: 11px; }
            .stage .hint { font-size: 10.5px; padding: 3px 8px; }
            .stage .hint .long { display: none; }
                }
    </style>
</head>
<body>

<div class="bar">
    <div class="title">
        {{ $game['name'] }}
        <small>{{ __('Advertisement') }}</small>
    </div>

    <div class="count">
        <div class="ring">
            <svg viewBox="0 0 52 52"><circle class="bg" cx="26" cy="26" r="22"></circle><circle class="fg" id="ringFg" cx="26" cy="26" r="22"></circle></svg>
            <div class="num" id="secNum">{{ $secondsLeft }}</div>
        </div>
        <div class="txt" id="statusTxt">{{ __('Loading advertisement...') }}</div>
    </div>

    <div class="math empty" id="mathBox">
        <span class="placeholder" id="mathPlaceholder">{{ __('A simple sum will appear here when the countdown ends.') }}</span>
        <span class="q" id="mathQ" style="display:none;"></span>
        <input type="number" id="mathAnswer" inputmode="numeric" autocomplete="off" placeholder="?" style="display:none;">
        <button type="button" id="mathBtn" style="display:none;">{{ __('Submit') }}</button>
        <div class="err" id="mathErr" style="display:none;"></div>
        <div class="ok" id="mathOk" style="display:none;"></div>
    </div>

    <a class="back" href="#" id="leaveBtn">{{ __('Leave') }}</a>
</div>

<div class="stage">
    @if ($ad && $ad->ad_type === 'link')
        <iframe src="{{ $ad->link }}" title="Advertisement" referrerpolicy="no-referrer-when-downgrade"
                sandbox="allow-scripts allow-same-origin allow-forms allow-popups allow-popups-to-escape-sandbox"
                onload="window.__adLoaded()"></iframe>
        <div class="hint">{{ __('Ad not showing?') }} <a href="{{ $ad->link }}" target="_blank" rel="noopener">{{ __('Open it in a new tab') }}</a><span class="long"> &mdash; {{ __('the countdown pauses while you are on another tab or your mouse is off this page.') }}</span></div>
    @elseif ($ad && $ad->ad_type === 'image')
        <div class="center">
            @if ($ad->link)
                <a href="{{ $ad->link }}" target="_blank" rel="noopener"><img src="{{ $ad->image_url }}" alt="Advertisement" onload="window.__adLoaded()" onerror="window.__adLoaded()"></a>
            @else
                <img src="{{ $ad->image_url }}" alt="Advertisement" onload="window.__adLoaded()" onerror="window.__adLoaded()">
            @endif
        </div>
    @elseif ($ad && $ad->ad_type === 'code')
        <div class="center"><div>{!! $ad->code !!}</div></div>
        <script>window.addEventListener('load', function () { window.__adLoaded(); });</script>
    @else
        <div class="center"><div><strong>{{ __('Sponsored message') }}</strong><br>{{ __('This advertisement is no longer available.') }}</div></div>
        <script>window.__adLoaded();</script>
    @endif
</div>

<script>
(function () {
    var urls = {
        loaded: @json(route('games.loaded', $play->id)),
        progress: @json(route('games.progress', $play->id)),
        question: @json(route('games.question', $play->id)),
        answer: @json(route('games.answer', $play->id)),
        leave: @json(route('games.leave', $play->id))
    };
    var backUrl = @json($backUrl);
    var duration = @json((int) $play->ad_duration);

    var tokenMeta = document.querySelector('meta[name="csrf-token"]');
    var token = tokenMeta ? tokenMeta.getAttribute('content') : '';

    var ring = document.getElementById('ringFg');
    var secNum = document.getElementById('secNum');
    var statusTxt = document.getElementById('statusTxt');
    var mathPlaceholder = document.getElementById('mathPlaceholder');
    var mathQ = document.getElementById('mathQ');
    var mathAnswer = document.getElementById('mathAnswer');
    var mathBtn = document.getElementById('mathBtn');
    var mathErr = document.getElementById('mathErr');
    var mathOk = document.getElementById('mathOk');
    var leaveBtn = document.getElementById('leaveBtn');
    var frame = document.querySelector('.stage iframe');

    var CIRC = 2 * Math.PI * 22;
    ring.style.strokeDasharray = CIRC;
    ring.style.strokeDashoffset = 0;

    var started = false;
    var finished = false;
    var timer = null;
    var remainingMs = 0;
    var lastTick = 0;
    var wasActive = true;
    var lastBeat = 0;
    var counting = false;

    /* ---- When does the countdown run? ----
       Only while this tab is visible AND (on a computer) the mouse is over
       the page. Leaving the tab or moving the mouse out of the window
       pauses it; coming back resumes it. Touch screens have no mouse, so
       only tab visibility is checked there. */
    var canHover = !!(window.matchMedia && window.matchMedia('(hover: hover)').matches);
    var mouseInside = true;

    function inside() { mouseInside = true; }
    function outside() { mouseInside = false; }

    document.addEventListener('mousemove', inside);
    document.addEventListener('mouseenter', inside);
    document.addEventListener('wheel', inside, { passive: true });
    document.addEventListener('scroll', inside, { passive: true });
    document.addEventListener('mouseout', function (e) { if (!e.relatedTarget) { outside(); } });
    document.documentElement.addEventListener('mouseleave', outside);
    if (frame) {
        // The ad lives in a cross-site frame, so its own mouse events are invisible here;
        // entering / leaving the frame element itself is still reported.
        frame.addEventListener('mouseenter', inside);
        frame.addEventListener('mouseleave', outside);
    }

    function isActive() {
        return !document.hidden && (canHover ? mouseInside : true);
    }

    function post(url, body) {
        return fetch(url, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(body || {})
        }).then(function (res) {
            return res.json().then(function (data) {
                return { status: res.status, ok: res.ok, data: data };
            }).catch(function () {
                return { status: res.status, ok: false, data: {} };
            });
        });
    }

    // The play was closed (left / finished): go back to the game.
    function handleClosed(r) {
        finished = true;
        window.location.href = (r && r.data && r.data.redirect) ? r.data.redirect : backUrl;
    }

    function render(s) {
        secNum.textContent = s;
        ring.style.strokeDashoffset = CIRC * (1 - Math.min(1, s / Math.max(1, duration)));
    }

    function setStatus(active) {
        if (!counting) { return; }
        if (active) {
            statusTxt.textContent = @json(__('Please wait until the countdown ends.'));
            ring.style.opacity = 1;
        } else if (document.hidden) {
            statusTxt.textContent = @json(__('Paused. Come back to this tab to continue.'));
            ring.style.opacity = 0.35;
        } else {
            statusTxt.textContent = @json(__('Paused. Move your mouse onto this page to continue.'));
            ring.style.opacity = 0.35;
        }
    }

    function sendProgress(seconds) {
        return post(urls.progress, { seconds: seconds }).then(function (r) {
            if (r.status === 410) { handleClosed(r); }
            if (r.status === 401) { window.location.reload(); }
            return r;
        }).catch(function () { return null; });
    }

    function tick() {
        var now = Date.now();
        var dt = now - lastTick;
        lastTick = now;

        var active = isActive();
        setStatus(active);

        // Count only time that was active for the whole interval.
        var counted = (active && wasActive) ? Math.min(dt, 1000) : 0;
        wasActive = active;

        if (!active) { return; }

        remainingMs -= counted;
        var s = Math.max(0, Math.ceil(remainingMs / 1000));
        render(s);

        if (now - lastBeat >= 3000) {
            lastBeat = now;
            sendProgress(Math.min(duration, Math.floor(duration - remainingMs / 1000)));
        }

        if (remainingMs <= 0) {
            clearInterval(timer);
            timer = null;
            counting = false;
            statusTxt.textContent = @json(__('Done! Solve the sum to see your result.'));
            ring.style.opacity = 1;
            // Tell the server the whole countdown was watched, then ask for the sum.
            sendProgress(duration).then(requestQuestion);
        }
    }

    function startCountdown(leftSeconds) {
        remainingMs = leftSeconds * 1000;
        lastTick = Date.now();
        lastBeat = lastTick;
        wasActive = isActive();
        counting = true;
        render(leftSeconds);
        setStatus(wasActive);
        if (timer) { clearInterval(timer); }
        timer = setInterval(tick, 250);
    }

    /* The ad has fully loaded: tell the server, then start the countdown. */
    function onAdLoaded() {
        if (started) { return; }
        started = true;

        post(urls.loaded).then(function (r) {
            if (r.status === 401) { window.location.reload(); return; }
            if (r.status === 410) { handleClosed(r); return; }
            var left = (r.ok && typeof r.data.seconds_left === 'number') ? r.data.seconds_left : duration;
            startCountdown(left);
        }).catch(function () {
            startCountdown(duration);
        });
    }

    window.__adStart = onAdLoaded;
    if (window.__adLoadedFlag) { onAdLoaded(); }
    // Safety net: never leave the player stuck if the ad never reports "loaded".
    setTimeout(function () { if (!started) { window.__adLoaded(); } }, 12000);

    /* Countdown finished: ask for the sum. */
    function requestQuestion() {
        if (finished) { return; }
        post(urls.question).then(function (r) {
            if (r.status === 401) { window.location.reload(); return; }
            if (r.status === 410) { handleClosed(r); return; }

            if (r.ok && r.data.question) {
                showQuestion(r.data.question);
                return;
            }

            var left = (r.data && typeof r.data.seconds_left === 'number') ? r.data.seconds_left : null;
            if (left !== null && left >= duration) {
                // The server never registered the ad as loaded: register it now.
                started = false;
                onAdLoaded();
            } else if (left !== null && left > 0) {
                // Server has a little less watched time than we do: keep counting.
                startCountdown(left);
            } else {
                setError(@json(__('Something went wrong. Please refresh the page.')));
            }
        }).catch(function () {
            setError(@json(__('Network error. Please refresh the page.')));
        });
    }

    function setError(text) {
        mathOk.style.display = 'none';
        mathErr.textContent = text;
        mathErr.style.display = text ? 'block' : 'none';
    }

    function showQuestion(question) {
        mathPlaceholder.style.display = 'none';
        document.getElementById('mathBox').classList.remove('empty');
        mathQ.textContent = question + ' = ?';
        mathQ.style.display = '';
        mathAnswer.style.display = '';
        mathBtn.style.display = '';
        mathBtn.disabled = false;
        mathAnswer.value = '';
        setError('');
        mathAnswer.focus();
    }

    function submitAnswer() {
        if (finished || mathBtn.disabled) { return; }

        var value = mathAnswer.value.trim();
        if (value === '') {
            setError(@json(__('Please type your answer.')));
            return;
        }

        mathBtn.disabled = true;
        setError('');

        post(urls.answer, { answer: value }).then(function (r) {
            if (r.status === 401) { window.location.reload(); return; }
            if (r.status === 410 || (r.data && (r.data.code === 'abandoned' || r.data.code === 'closed'))) { handleClosed(r); return; }

            if (r.ok && r.data.ok) {
                finished = true;
                mathErr.style.display = 'none';
                mathOk.textContent = @json(__('Correct! Revealing your result...'));
                mathOk.style.display = 'block';
                window.location.href = r.data.redirect;
                return;
            }

            if (r.data && r.data.code === 'wrong' && r.data.question) {
                showQuestion(r.data.question);
                setError(r.data.message);
                return;
            }

            var text = r.data && r.data.message ? r.data.message : @json(__('Something went wrong. Please try again.'));
            setError(text);
            mathBtn.disabled = false;
        }).catch(function () {
            setError(@json(__('Network error. Please try again.')));
            mathBtn.disabled = false;
        });
    }

    mathBtn.addEventListener('click', submitAnswer);
    mathAnswer.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') { e.preventDefault(); submitAnswer(); }
    });

    /* Leave: this play is closed for good and cannot be reopened. */
    leaveBtn.addEventListener('click', function (e) {
        e.preventDefault();
        if (!window.confirm(@json(__('If you leave, this game is lost and it still counts towards your hourly limit. You cannot come back to this advertisement. Leave anyway?')))) {
            return;
        }
        finished = true;
        if (timer) { clearInterval(timer); }
        post(urls.leave).then(function (r) {
            window.location.href = (r && r.data && r.data.redirect) ? r.data.redirect : backUrl;
        }).catch(function () {
            window.location.href = backUrl;
        });
    });
})();
</script>

</body>
</html>
