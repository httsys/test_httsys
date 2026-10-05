@extends('layouts.auth')

@section('content')

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-8 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5" style="background: rgba(255, 255, 255, 0.55); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.6); border-radius: 16px;">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-2">{{ __('Verify Your Email') }}</h1>
                                    <p class="mb-4 text-gray-600" style="font-size: 14px;">
                                        {{ __('We sent a 6-digit code to') }} <strong>{{ $email }}</strong>. {{ __('Enter it below to continue.') }}
                                    </p>
                                </div>

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @error('code')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <form method="POST" action="{{ route('verification.code.verify') }}" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input id="code" type="text" inputmode="numeric" pattern="[0-9]*" maxlength="6" placeholder="{{ __('6-digit code') }}" class="form-control form-control-user text-center" style="letter-spacing: 8px; font-size: 20px; background: rgba(255,255,255,0.7); border: 1.5px solid rgba(120,130,150,0.35);" name="code" required autofocus autocomplete="one-time-code">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Verify & Continue') }}
                                    </button>
                                </form>

                                <hr>

                                <div class="text-center" id="resend-wrap">
                                    @if ($resendsLeft > 0)
                                        <form method="POST" action="{{ route('verification.code.resend') }}" id="resend-form">
                                            @csrf
                                            <button type="submit" class="btn btn-link small" id="resend-btn" {{ $secondsRemaining > 0 ? 'disabled' : '' }}>
                                                <span id="resend-label">
                                                    {{ __('Resend code') }}
                                                    @if ($secondsRemaining > 0)
                                                        (<span id="countdown">{{ $secondsRemaining }}</span>s)
                                                    @endif
                                                </span>
                                            </button>
                                        </form>
                                        <p class="text-muted" style="font-size: 12px;">{{ $resendsLeft }} {{ __('resend(s) remaining') }}</p>
                                    @else
                                        <p class="text-muted small">{{ __('You have reached the maximum number of resends.') }}</p>
                                    @endif
                                </div>

                                <div class="text-center mt-2">
                                    <a class="small" href="{{ route('login') }}">{{ __('Back to login') }}</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@if ($secondsRemaining > 0)
<script>
    (function () {
        var remaining = {{ (int) $secondsRemaining }};
        var countdownEl = document.getElementById('countdown');
        var labelEl = document.getElementById('resend-label');
        var btn = document.getElementById('resend-btn');

        var timer = setInterval(function () {
            remaining -= 1;
            if (remaining <= 0) {
                clearInterval(timer);
                labelEl.textContent = '{{ __('Resend code') }}';
                btn.disabled = false;
                return;
            }
            if (countdownEl) {
                countdownEl.textContent = remaining;
            }
        }, 1000);
    })();
</script>
@endif

@endsection
