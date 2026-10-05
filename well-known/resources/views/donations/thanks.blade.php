@extends('layouts.front')

@section('title') {{ __('donation.page_title') }} @endsection

@section('content')

<div class="breadcrumb-area">
    <div class="container">
        <ul class="page-list">
            <li class="item-home"><a class="bread-link" href="{{ route('home') }}" title="Home">Home</a></li>
            <li class="separator separator-home"></li>
            <li class="item-current">{{ __('donation.page_title') }}</li>
        </ul>
        <h1 class="breadcrumb-title">{{ __('donation.page_title') }}</h1>
        <ul class="shape-group-code">
            <li class="shape shape-1"><img src="/public/img/bubble-9.png" alt="circle"></li>
            <li class="shape shape-2"><img src="/public/img/bubble-17.png" alt="circle"></li>
            <li class="shape shape-3"><img src="/public/img/line-4.png" alt="circle"></li>
        </ul>
    </div>
</div>

<div class="blog-page-section">
<div class="container text-center">
    <div class="donate-box" style="max-width: 560px; margin: 0 auto; background: #fff; border-radius: 14px; padding: 40px; box-shadow: 0 4px 24px rgba(0,0,0,0.06);">

        @php
            $amountText = '৳' . number_format($donation->amount, 2);
        @endphp

        @if ($donation->status === 'completed')
            <h2 class="text-success mb-3">{{ __('donation.thanks_completed_title') }}</h2>
            <p>{{ __('donation.thanks_completed_body', ['amount' => $amountText, 'fund' => $donation->fund->title]) }}</p>
        @elseif ($donation->status === 'pending')
            <h2 class="mb-3">{{ __('donation.thanks_pending_title') }}</h2>
            <p>{{ __('donation.thanks_pending_body', ['amount' => $amountText, 'fund' => $donation->fund->title]) }}</p>
        @elseif ($donation->status === 'cancelled')
            <h2 class="text-warning mb-3">{{ __('donation.thanks_cancelled_title') }}</h2>
            <p>{{ __('donation.thanks_cancelled_body') }}</p>
        @else
            <h2 class="text-danger mb-3">{{ __('donation.thanks_failed_title') }}</h2>
            <p>{{ __('donation.thanks_failed_body') }}</p>
        @endif

        <p class="text-muted">{{ __('donation.reference_label') }}: {{ $donation->reference }}</p>

        <a href="{{ route('donations.index') }}" class="btn btn-outline-primary mr-2">{{ __('donation.donate_again') }}</a>
        @auth
            <a href="{{ route('profile.show') }}" class="btn btn-primary">{{ __('donation.view_my_donations') }}</a>
        @endauth
    </div>
</div>
</div>

@stop
