@extends('layouts.front')

@section('title') {{ __('Mini Games') }} @endsection
@section('meta') {{ __('Play mini games and earn points') }} @endsection

@section('content')

@include('games._styles')

<div class="breadcrumb-area">
    <div class="container">
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">Home</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">{{ __('Mini Games') }}</li>
        </ul>
        <h1 class="breadcrumb-title">{{ __('Mini Games') }}</h1>
        <ul class="shape-group-code">
            <li class="shape shape-1"><img src="/public/img/bubble-9.png" alt="circle"></li>
            <li class="shape shape-2"><img src="/public/img/bubble-17.png" alt="circle"></li>
            <li class="shape shape-3"><img src="/public/img/line-4.png" alt="circle"></li>
        </ul>
    </div>
</div>

<div class="blog-page-section">
<div class="container">
    <div class="mg-wrap">

        <div class="mg-head">
            <div class="mg-icon"><i class="fas fa-trophy"></i></div>
            <h2>{{ __('Mini Games') }}</h2>
            <p>{{ __('Play games and earn rewards') }}</p>
            @if ($isGuest)
                <a href="{{ route('login') }}?redirect_to={{ urlencode(url()->current()) }}" class="mg-points-pill"><i class="fas fa-sign-in-alt"></i> {{ __('Login to play and see your points') }}</a>
            @else
                <a href="{{ route('profile.show') }}#points" class="mg-points-pill"><i class="fas fa-coins"></i> {{ __('My Points') }}: {{ number_format($points) }}</a>
            @endif
        </div>

        <div class="mg-cards">
            @foreach ($cards as $card)
                <a href="{{ route('games.show', $card['slug']) }}" class="mg-card {{ $card['setting']->is_active ? '' : 'is-off' }}">
                    <div class="mg-art">
                        @if ($card['key'] === 'spin_wheel')
                            <div class="mg-mini-wheel"></div>
                        @elseif ($card['key'] === 'flip_coin')
                            <div class="mg-mini-coin">$</div>
                        @elseif ($card['key'] === 'three_numbers')
                            <div class="mg-mini-slot"><span>1</span><span>0</span><span>0</span></div>
                        @else
                            <svg class="mg-mini-chart" viewBox="0 0 160 110" xmlns="http://www.w3.org/2000/svg">
                                <defs><linearGradient id="mgCg" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#00b5ff" stop-opacity=".55"/><stop offset="1" stop-color="#00b5ff" stop-opacity="0"/></linearGradient></defs>
                                <path d="M0,80 L15,70 L28,78 L45,52 L60,60 L75,38 L90,48 L105,24 L120,34 L135,18 L160,26 L160,110 L0,110 Z" fill="url(#mgCg)"/>
                                <path d="M0,80 L15,70 L28,78 L45,52 L60,60 L75,38 L90,48 L105,24 L120,34 L135,18 L160,26" fill="none" stroke="#00b5ff" stroke-width="2.5" stroke-linejoin="round"/>
                                <circle cx="160" cy="26" r="4" fill="#00b5ff"/>
                            </svg>
                        @endif
                    </div>
                    <div class="mg-name">{{ $card['name'] }}</div>
                    @if ($card['setting']->is_active)
                        <div class="mg-play"><i class="far fa-play-circle"></i> {{ __('Play Now') }}</div>
                        <div class="mg-left">
                            {{ __('Plays left this hour') }}:
                            {{ $card['remaining'] === null ? __('Unlimited') : $card['remaining'] }}
                        </div>
                    @else
                        <div class="mg-play" style="color:#8f97ad;">{{ __('Currently unavailable') }}</div>
                    @endif
                </a>
            @endforeach
        </div>

        <div class="mg-info">
            <strong>{{ __('How it works') }}</strong>
            {{ __('Start a game and reveal your result. Some games first show a short advertisement and a simple sum to answer. Win and you earn points. Each game has a limit on how many times you can play every hour.') }}
        </div>

    </div>
</div>
</div>

@endsection
