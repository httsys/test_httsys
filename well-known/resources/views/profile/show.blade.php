@extends('layouts.front')

@section('title') {{ __('My Account') }} @endsection

@section('content')

<style>
    :root {
        --brand-primary: #0097ff;
        --brand-primary-dark: #0078ff;
        --brand-accent: #e34a4a;
        --brand-success: #0f9d58;
    }

    body { background: #f4f6fa !important; }

    * { box-sizing: border-box; }
    html, body { max-width: 100%; overflow-x: hidden; }
    .acc-wrap { max-width: 1140px; margin: 0 auto; padding: 110px 16px 60px; overflow-x: hidden; }

    .acc-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .acc-topbar .brand { font-weight: 800; font-size: 20px; color: var(--brand-primary-dark); text-decoration: none; }
    .acc-topbar .brand:hover { color: var(--brand-primary-dark); text-decoration: none; }

    .acc-shell { display: flex; align-items: flex-start; gap: 22px; max-width: 100%; }

    /* Sidebar */
    .acc-sidebar {
        flex: 0 0 270px;
        min-width: 0;
        max-width: 100%;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(20, 30, 60, 0.06);
        padding: 26px 20px;
        position: sticky;
        top: 20px;
    }
    .acc-avatar {
        width: 76px; height: 76px; border-radius: 50%;
        background: linear-gradient(135deg, var(--brand-primary), var(--brand-primary-dark));
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 14px; color: #fff; font-size: 30px;
        border: 3px solid #eaf6ff;
    }
    .acc-name { text-align: center; font-weight: 700; font-size: 17px; color: #1a1a1a; margin-bottom: 2px; }
    .acc-sub { text-align: center; font-size: 12.5px; color: #8a93a3; margin-bottom: 20px; word-break: break-word; }

    .acc-nav { list-style: none; margin: 0; padding: 0; }
    .acc-nav li { margin-bottom: 4px; }
    .acc-nav a {
        display: flex; align-items: center; gap: 12px;
        padding: 11px 14px; border-radius: 9px;
        color: #4b5468; font-weight: 600; font-size: 14.5px;
        text-decoration: none; transition: all .15s ease;
    }
    .acc-nav a i { width: 18px; text-align: center; font-size: 15px; color: #9aa3b5; }
    .acc-nav a:hover { background: #f2f8ff; color: var(--brand-primary-dark); text-decoration: none; }
    .acc-nav a:hover i { color: var(--brand-primary); }
    .acc-nav a.active { background: var(--brand-primary); color: #fff; }
    .acc-nav a.active i { color: #fff; }
    .acc-nav .badge-count {
        margin-left: auto; background: rgba(0,0,0,0.07); color: #5a6478;
        font-size: 11px; font-weight: 700; border-radius: 20px; padding: 1px 8px;
    }
    .acc-nav a.active .badge-count { background: rgba(255,255,255,0.25); color: #fff; }

    .acc-logout-btn {
        display: block; width: 100%; text-align: center; margin-top: 18px;
        padding: 10px; border-radius: 9px; border: 1.5px solid #f0d4d4;
        background: #fff5f5; color: var(--brand-accent); font-weight: 700; font-size: 14px;
        cursor: pointer;
    }
    .acc-logout-btn:hover { background: var(--brand-accent); color: #fff; border-color: var(--brand-accent); }

    /* Content */
    .acc-content {
        flex: 1 1 0;
        min-width: 0;
        max-width: 100%;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(20, 30, 60, 0.06);
        padding: 28px 30px;
        min-height: 420px;
        overflow-x: hidden;
    }
    .acc-content h2 { font-size: 20px; font-weight: 800; color: #1a1a1a; margin-bottom: 4px; }
    .acc-content .acc-welcome { color: #8a93a3; font-size: 14px; margin-bottom: 24px; }

    .tab-pane-acc { display: none; }
    .tab-pane-acc.active { display: block; }

    /* Stat cards (Overview) */
    .acc-stats { display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 28px; }
    .acc-stat-card {
        flex: 1 1 150px; background: #fafcff; border: 1px solid #eef2f8; border-radius: 12px;
        padding: 16px 18px;
    }
    .acc-stat-icon {
        width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center;
        justify-content: center; color: #fff; font-size: 16px; margin-bottom: 10px;
    }
    .acc-stat-icon.c-primary { background: var(--brand-primary); }
    .acc-stat-icon.c-accent { background: var(--brand-accent); }
    .acc-stat-icon.c-success { background: var(--brand-success); }
    .acc-stat-num { font-size: 22px; font-weight: 800; color: #1a1a1a; line-height: 1.1; }
    .acc-stat-label { font-size: 12.5px; color: #8a93a3; margin-top: 2px; }

    .acc-section-title { display: flex; justify-content: space-between; align-items: center; margin: 26px 0 12px; }
    .acc-section-title h3 { font-size: 15.5px; font-weight: 800; color: #1a1a1a; margin: 0; }
    .acc-section-title:first-child { margin-top: 0; }

    /* Badges */
    .acc-badge { padding: 4px 12px; border-radius: 20px; font-size: 11.5px; font-weight: 700; display: inline-block; }
    .acc-badge-success { background: #e5f8ee; color: var(--brand-success); }
    .acc-badge-warning { background: #fef3d7; color: #b98900; }
    .acc-badge-danger { background: #fdeaea; color: var(--brand-accent); }
    .acc-badge-muted { background: #eef0f4; color: #6c7488; }

    .acc-row {
        display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;
        padding: 14px 16px; border: 1px solid #eef1f6; border-radius: 10px; margin-bottom: 10px;
        max-width: 100%; overflow-wrap: anywhere;
    }
    .acc-row > div { min-width: 0; max-width: 100%; overflow-wrap: anywhere; }
    .acc-row .acc-row-main strong { font-size: 14px; color: #1a1a1a; }
    .acc-row .acc-row-main .small { color: #8a93a3; }

    .acc-empty { text-align: center; color: #9aa3b5; padding: 36px 10px; font-size: 14px; }
    .acc-pager { display: flex; flex-wrap: wrap; align-items: center; justify-content: center; gap: 6px; margin-top: 18px; }
    .acc-pager-btn {
        min-width: 34px; height: 34px; padding: 0 8px; border: 1.5px solid #e6ecf5; background: #fff;
        border-radius: 8px; font-size: 13px; font-weight: 600; color: #4a5568; cursor: pointer;
    }
    .acc-pager-btn:hover:not([disabled]) { border-color: #00b5ff; color: #00b5ff; }
    .acc-pager-btn.active { background: #0078ff; border-color: #0078ff; color: #fff; }
    .acc-pager-btn[disabled] { opacity: .4; cursor: not-allowed; }

    .acc-form-group label { font-weight: 700; font-size: 13px; color: #5a6478; }
    .acc-readonly {
        background: #fafcff !important; border: 1.5px solid #eef2f8 !important; border-radius: 8px !important;
    }

    .acc-pending-notice {
        background: #fef3d7; border: 1px solid #f0dba3; color: #8a6a00; border-radius: 10px;
        padding: 14px 16px; margin-bottom: 20px; font-size: 13.5px;
    }
    .acc-pending-notice ul { padding-left: 20px; }

    .acc-photo-row { display: flex; align-items: center; gap: 18px; margin-bottom: 24px; }
    .acc-photo-preview {
        width: 70px; height: 70px; border-radius: 50%; object-fit: cover;
        border: 2px solid #eef2f8; flex-shrink: 0;
    }

    @media (max-width: 860px) {
        .acc-wrap { padding-top: 90px; padding-left: 12px; padding-right: 12px; }
        .acc-shell { flex-direction: column; }
        .acc-sidebar { flex: 1 1 auto; width: 100%; max-width: 100%; position: static; }
        /* Two even columns instead of a wrapping flex row, so every button
           lines up in tidy pairs no matter how long its label is. */
        .acc-nav { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
        .acc-nav li { margin-bottom: 0; }
        .acc-nav a {
            display: flex; align-items: center; gap: 8px; height: 100%;
            padding: 11px 10px; font-size: 13px; white-space: nowrap;
            overflow: hidden; text-overflow: ellipsis;
        }
        .acc-nav a span.badge-count { margin-left: auto; flex-shrink: 0; }
        .acc-avatar, .acc-name, .acc-sub { display: none; }
        .acc-content { padding: 20px 18px; }
    }

    #notesGrid { column-count: 1; column-gap: 14px; }
    @media (min-width: 576px) { #notesGrid { column-count: 2; } }
    @media (min-width: 992px) { #notesGrid { column-count: 2; } }
</style>

<div class="acc-wrap">

    <div class="acc-shell">

        {{-- Sidebar --}}
        <div class="acc-sidebar">
            <div class="acc-avatar"><i class="fas fa-user"></i></div>
            <div class="acc-name">{{ $user->name }}</div>
            <div class="acc-sub">{{ $user->phone ?: $user->email }}</div>

            <ul class="acc-nav" id="accNav">
                <li><a href="#overview" data-tab="overview" class="active"><i class="fas fa-th-large"></i> {{ __('Overview') }}</a></li>
                <li><a href="#orders" data-tab="orders"><i class="fas fa-shopping-bag"></i> {{ __('My Orders') }} <span class="badge-count">{{ $orders->count() }}</span></a></li>
                <li><a href="#returns" data-tab="returns"><i class="fas fa-undo"></i> {{ __('Return Orders') }} <span class="badge-count">{{ $returns->count() }}</span></a></li>
                <li><a href="#digital" data-tab="digital"><i class="fas fa-download"></i> {{ __('Digital Products') }} <span class="badge-count">{{ $digitalItems->count() }}</span></a></li>
                <li><a href="#donations" data-tab="donations"><i class="fas fa-hand-holding-heart"></i> {{ __('My Donations') }} <span class="badge-count">{{ $donations->count() }}</span></a></li>
                <li><a href="#wallet" data-tab="wallet"><i class="fas fa-wallet"></i> {{ __('Wallet') }}</a></li>
                <li><a href="#points" data-tab="points"><i class="fas fa-coins"></i> {{ __('My Points') }} <span class="badge-count">{{ number_format((int) $user->points) }}</span></a></li>
                <li><a href="#currency" data-tab="currency"><i class="fas fa-exchange-alt"></i> {{ __('Currency Exchange') }}</a></li>
                <li><a href="#marketplace" data-tab="marketplace"><i class="fas fa-store"></i> {{ __('Marketplace') }}</a></li>
                <li><a href="{{ route('games.index') }}"><i class="fas fa-gamepad"></i> {{ __('Mini Games') }}</a></li>
                <li><a href="#notepad" data-tab="notepad"><i class="fas fa-sticky-note"></i> {{ __('My Notepad') }}</a></li>
                <li><a href="#account" data-tab="account"><i class="fas fa-user-cog"></i> {{ __('Account Info') }}</a></li>
                @if (method_exists($user, 'isAuthor') && $user->isAuthor())
                    <li><a href="{{ route('dashboard.index') }}"><i class="fas fa-tachometer-alt"></i> {{ __('Admin Dashboard') }}</a></li>
                @endif
            </ul>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="acc-logout-btn"><i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}</button>
            </form>
        </div>

        {{-- Content --}}
        <div class="acc-content">

            {{-- OVERVIEW --}}
            <div class="tab-pane-acc active" id="pane-overview">
                <h2>{{ __('Overview') }}</h2>
                <div class="acc-welcome">{{ __('Welcome back') }}, {{ $user->name }}!</div>

                <div class="acc-stats">
                    <div class="acc-stat-card">
                        <div class="acc-stat-icon c-primary"><i class="fas fa-shopping-bag"></i></div>
                        <div class="acc-stat-num">{{ $orders->count() }}</div>
                        <div class="acc-stat-label">{{ __('Total Orders') }}</div>
                    </div>
                    <div class="acc-stat-card">
                        <div class="acc-stat-icon c-success"><i class="fas fa-check-circle"></i></div>
                        <div class="acc-stat-num">{{ $orders->where('status', 'delivered')->count() }}</div>
                        <div class="acc-stat-label">{{ __('Completed Orders') }}</div>
                    </div>
                    <div class="acc-stat-card">
                        <div class="acc-stat-icon c-accent"><i class="fas fa-hand-holding-heart"></i></div>
                        <div class="acc-stat-num">৳{{ number_format($donations->where('status', 'completed')->sum('amount'), 0) }}</div>
                        <div class="acc-stat-label">{{ __('Total Donated') }}</div>
                    </div>
                </div>

                <div class="acc-section-title"><h3>{{ __('Recent Orders') }}</h3>
                    @if ($orders->isNotEmpty())<a href="#orders" class="small acc-tab-link" data-tab="orders" style="color:var(--brand-primary); font-weight:700;">{{ __('View all') }}</a>@endif
                </div>
                @if ($orders->isEmpty())
                    <div class="acc-empty">{{ __("You haven't placed any orders yet.") }}</div>
                @else
                    @foreach ($orders->take(3) as $order)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>#{{ $order->order_number }}</strong><br>
                                <span class="small">{{ $order->created_at->format('d M Y, h:i A') }}</span>
                            </div>
                            <div>{{ $order->currency }}{{ number_format($order->total, 2) }}</div>
                            <div>
                                <span class="acc-badge {{ $order->payment_status === 'paid' ? 'acc-badge-success' : 'acc-badge-danger' }}">{{ ucfirst($order->payment_status) }}</span>
                                <span class="acc-badge acc-badge-warning">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                            </div>
                            <div><a href="{{ route('checkout.confirmation', $order->id) }}" class="btn btn-sm btn-outline-primary">{{ __('View') }}</a></div>
                        </div>
                    @endforeach
                @endif

                <div class="acc-section-title"><h3>{{ __('Recent Donations') }}</h3>
                    @if ($donations->isNotEmpty())<a href="#donations" class="small acc-tab-link" data-tab="donations" style="color:var(--brand-primary); font-weight:700;">{{ __('View all') }}</a>@endif
                </div>
                @if ($donations->isEmpty())
                    <div class="acc-empty">{{ __('You have not made any donations yet.') }}</div>
                @else
                    @foreach ($donations->take(3) as $donation)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>{{ $donation->fund->title ?? '—' }}</strong><br>
                                <span class="small">{{ $donation->created_at->format('d M Y') }}</span>
                            </div>
                            <div>৳{{ number_format($donation->amount, 2) }}</div>
                            <div>
                                @if ($donation->status === 'completed')
                                    <span class="acc-badge acc-badge-success">{{ __('Completed') }}</span>
                                @elseif ($donation->status === 'pending')
                                    <span class="acc-badge acc-badge-warning">{{ __('Pending') }}</span>
                                @elseif ($donation->status === 'cancelled')
                                    <span class="acc-badge acc-badge-muted">{{ __('Cancelled') }}</span>
                                @else
                                    <span class="acc-badge acc-badge-danger">{{ __('Failed') }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- ORDERS --}}
            <div class="tab-pane-acc" id="pane-orders">
                <h2>{{ __('My Orders') }}</h2>
                <div class="acc-welcome">{{ __('Every order placed from your shopping cart.') }}</div>

                @if ($orders->isEmpty())
                    <div class="acc-empty">{{ __("You haven't placed any orders yet.") }} <a href="{{ route('shop.index') }}" style="color:var(--brand-primary); font-weight:700;">{{ __('Continue shopping') }}</a>.</div>
                @else
                    @foreach ($orders as $order)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>#{{ $order->order_number }}</strong><br>
                                <span class="small">{{ $order->created_at->format('d M Y, h:i A') }}</span>
                            </div>
                            <div>{{ $order->currency }}{{ number_format($order->total, 2) }}</div>
                            <div>
                                <span class="acc-badge {{ $order->payment_status === 'paid' ? 'acc-badge-success' : 'acc-badge-danger' }}">{{ ucfirst($order->payment_status) }}</span>
                                <span class="acc-badge acc-badge-warning">{{ ucfirst(str_replace('_', ' ', $order->status)) }}</span>
                            </div>
                            <div><a href="{{ route('checkout.confirmation', $order->id) }}" class="btn btn-sm btn-outline-primary">{{ __('View') }}</a></div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- RETURN ORDERS --}}
            <div class="tab-pane-acc" id="pane-returns">
                <h2>{{ __('Return Orders') }}</h2>
                <div class="acc-welcome">{{ __('Requests you\'ve submitted to return an item, and their status.') }}</div>

                @if (session('profile_success'))
                    <div class="alert alert-success">{{ session('profile_success') }}</div>
                @endif
                @if (session('cart_error'))
                    <div class="alert alert-danger">{{ session('cart_error') }}</div>
                @endif

                @if ($returns->isEmpty())
                    <div class="acc-empty">{{ __("You haven't requested any returns yet.") }}</div>
                @else
                    @foreach ($returns as $return)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>#{{ optional($return->order)->order_number }}</strong><br>
                                <span class="small">{{ $return->created_at->format('d M Y, h:i A') }}</span>
                            </div>
                            <div>{{ $return->items->count() }} {{ __('Product') }}{{ $return->items->count() === 1 ? '' : 's' }}</div>
                            <div>
                                @php
                                    $returnBadge = ['pending' => 'acc-badge-warning', 'accepted' => 'acc-badge-success', 'rejected' => 'acc-badge-danger'][$return->status] ?? 'acc-badge-warning';
                                @endphp
                                <span class="acc-badge {{ $returnBadge }}">{{ ucfirst($return->status) }}</span>
                            </div>
                            <div>{{ optional($return->order)->currency }}{{ number_format($return->amount, 2) }}</div>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#returnDetail{{ $return->id }}">{{ __('View') }}</button>
                            </div>
                        </div>

                        <div class="modal fade" id="returnDetail{{ $return->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ __('Return Request') }} — #{{ optional($return->order)->order_number }}</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>{{ __('Status') }}:</strong> <span class="acc-badge {{ $returnBadge }}">{{ ucfirst($return->status) }}</span></p>
                                        <p><strong>{{ __('Reason') }}:</strong> {{ $return->reason }}</p>
                                        <p><strong>{{ __('Items') }}:</strong></p>
                                        <ul>
                                            @foreach ($return->items as $ri)
                                                <li>{{ optional($ri->orderItem)->product_title }} &times; {{ $ri->quantity }}</li>
                                            @endforeach
                                        </ul>
                                        @if ($return->admin_note)
                                            <p><strong>{{ __('Note from store') }}:</strong> {{ $return->admin_note }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- DIGITAL PRODUCTS --}}
            <div class="tab-pane-acc" id="pane-digital">
                <h2>{{ __('Digital Products') }}</h2>
                <div class="acc-welcome">{{ __('Files and links for every digital product you have ordered.') }}</div>

                @if ($digitalItems->isEmpty())
                    <div class="acc-empty">{{ __("You haven't ordered any digital products yet.") }} <a href="{{ route('shop.index') }}" style="color:var(--brand-primary); font-weight:700;">{{ __('Browse the shop') }}</a>.</div>
                @else
                    @foreach ($digitalItems as $item)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>{{ $item->product_title }}</strong><br>
                                <span class="small">{{ __('Order') }} #{{ $item->order->order_number }} — {{ $item->order->created_at->format('d M Y') }}</span>
                            </div>
                            <div>
                                @if ($item->order->payment_status === 'paid')
                                    @php $downloadUrl = ($item->product && $item->product->digitalFile) ? '/public/images/media/' . $item->product->digitalFile->file : ($item->product->digital_link ?? null); @endphp
                                    @if ($downloadUrl)
                                        <a href="{{ $downloadUrl }}" target="_blank" class="btn btn-sm" style="background: var(--brand-primary); color:#fff; font-weight:700;">⬇ {{ __('Download') }}</a>
                                    @else
                                        <span class="acc-badge acc-badge-muted">{{ __('No file set yet') }}</span>
                                    @endif
                                @else
                                    <span class="acc-badge acc-badge-warning">{{ __('Awaiting payment confirmation') }}</span>
                                @endif
                            </div>
                            <div><a href="{{ route('checkout.confirmation', $item->order->id) }}" class="btn btn-sm btn-outline-primary">{{ __('View Order') }}</a></div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- DONATIONS --}}
            <div class="tab-pane-acc" id="pane-donations">
                <div class="d-flex justify-content-between align-items-center" style="margin-bottom: 4px;">
                    <h2 style="margin-bottom:0;">{{ __('My Donations') }}</h2>
                    <a href="{{ route('donations.index') }}" class="btn btn-sm" style="background: var(--brand-primary); color:#fff; font-weight:700;">{{ __('Donate Again') }}</a>
                </div>
                <div class="acc-welcome">{{ __('All donations linked to your account.') }}</div>

                @if ($donations->isEmpty())
                    <div class="acc-empty">{{ __('You have not made any donations yet.') }}</div>
                @else
                    <div class="table-responsive mb-3">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Fund') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Payment Method') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donations as $donation)
                                    <tr>
                                        <td>{{ $donation->created_at->format('d M Y') }}</td>
                                        <td>{{ $donation->fund->title ?? '—' }}</td>
                                        <td>৳{{ number_format($donation->amount, 2) }}</td>
                                        <td>{{ $donation->paymentMethod->name ?? '—' }}</td>
                                        <td>
                                            @if ($donation->status === 'completed')
                                                <span class="acc-badge acc-badge-success">{{ __('Completed') }}</span>
                                            @elseif ($donation->status === 'pending')
                                                <span class="acc-badge acc-badge-warning">{{ __('Pending') }}</span>
                                            @elseif ($donation->status === 'cancelled')
                                                <span class="acc-badge acc-badge-muted">{{ __('Cancelled') }}</span>
                                            @else
                                                <span class="acc-badge acc-badge-danger">{{ __('Failed') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="small text-right font-weight-bold">
                        {{ __('Total donated') }}: ৳{{ number_format($donations->where('status', 'completed')->sum('amount'), 2) }}
                    </p>
                @endif
            </div>

            {{-- WALLET --}}
            <div class="tab-pane-acc" id="pane-wallet">
                <h2>{{ __('Wallet') }}</h2>
                <div class="acc-welcome">{{ __('Money released to you shows up here. Request a withdrawal any time.') }}</div>

                @if (session('wallet_success'))
                    <div class="alert alert-success">{{ session('wallet_success') }}</div>
                @endif
                @if (session('wallet_error'))
                    <div class="alert alert-danger">{{ session('wallet_error') }}</div>
                @endif

                <div class="acc-stats" style="margin-bottom: 20px;">
                    <div class="acc-stat-card">
                        <div class="acc-stat-icon c-success"><i class="fas fa-wallet"></i></div>
                        <div class="acc-stat-num">৳{{ number_format($walletBalance, 2) }}</div>
                        <div class="acc-stat-label">{{ __('Available Balance') }}</div>
                    </div>
                    <div class="acc-stat-card">
                        <div class="acc-stat-icon c-primary"><i class="fas fa-coins"></i></div>
                        <div class="acc-stat-num">{{ number_format((int) $user->points) }}</div>
                        <div class="acc-stat-label">{{ __('Points (1 point = ৳1)') }}</div>
                    </div>
                </div>

                <div class="acc-section-title"><h3>{{ __('Load Money') }}</h3></div>
                <p class="text-muted small">{{ __('Pay using any method below and submit your reference — the amount is added once an admin confirms it.') }}</p>
                <form method="POST" action="{{ route('wallet.topup') }}" class="mb-4" id="topupForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group acc-form-group">
                                <label>{{ __('Amount (৳)') }}</label>
                                <input type="number" step="0.01" min="1" name="amount" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group acc-form-group">
                                <label>{{ __('Pay using') }}</label>
                                <select name="payment_method_id" id="topupMethodSelect" class="form-control" required>
                                    <option value="">{{ __('Choose a payment method') }}</option>
                                    @foreach ($walletPaymentMethods as $method)
                                        <option value="{{ $method->id }}"
                                                data-account-number="{{ $method->configValue('account_number') }}"
                                                data-account-name="{{ $method->configValue('account_name') }}">
                                            {{ $method->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group acc-form-group">
                                <label>{{ __('Transaction / Reference Number') }}</label>
                                <input type="text" name="payment_reference" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div id="topupPayToBox" style="display:none; margin-bottom: 14px;">
                        <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; background:#f4f7fc; border:1.5px solid #e3e6ec; border-radius:10px; padding:12px 16px;">
                            <div>
                                <div style="font-size:18px; font-weight:700;" id="topupPayToNumber"></div>
                                <div style="font-size:12px; color:#888;" id="topupPayToName"></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn" style="background: var(--brand-primary); color:#fff; font-weight:700;">{{ __('Submit for Approval') }}</button>
                </form>
                <script>
                    document.getElementById('topupMethodSelect').addEventListener('change', function () {
                        var opt = this.options[this.selectedIndex];
                        var box = document.getElementById('topupPayToBox');
                        var number = opt.getAttribute('data-account-number') || '';
                        if (!opt.value || !number) { box.style.display = 'none'; return; }
                        document.getElementById('topupPayToNumber').textContent = number;
                        document.getElementById('topupPayToName').textContent = opt.getAttribute('data-account-name') || '';
                        box.style.display = 'block';
                    });
                </script>

                <div class="acc-section-title"><h3>{{ __('Request a Withdrawal') }}</h3></div>
                <form method="POST" action="{{ route('wallet.withdraw') }}" class="mb-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group acc-form-group">
                                <label>{{ __('Amount (৳)') }}</label>
                                <input type="number" step="0.01" min="1" name="amount" value="{{ old('amount') }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group acc-form-group">
                                <label>{{ __('Method') }}</label>
                                <select name="method" class="form-control" required>
                                    <option value="bkash" {{ old('method') == 'bkash' ? 'selected' : '' }}>bKash</option>
                                    <option value="nagad" {{ old('method') == 'nagad' ? 'selected' : '' }}>Nagad</option>
                                    <option value="bank" {{ old('method') == 'bank' ? 'selected' : '' }}>{{ __('Bank Transfer') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group acc-form-group">
                                <label>{{ __('Account Number / Details') }}</label>
                                <input type="text" name="account_details" value="{{ old('account_details') }}" class="form-control" placeholder="{{ __('Phone number or bank account details') }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn" style="background: var(--brand-primary); color:#fff; font-weight:700;">{{ __('Submit Request') }}</button>
                </form>

                <div class="acc-section-title"><h3>{{ __('Convert Points ⇄ Wallet') }}</h3></div>
                <p class="text-muted small">{{ __('1 point = ৳1, either direction.') }}</p>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('wallet.convert-points') }}" class="form-inline">
                            @csrf
                            <input type="number" min="1" max="{{ (int) $user->points }}" name="points" class="form-control mr-2 mb-2" placeholder="{{ __('Points') }}" style="width:120px;" required>
                            <button type="submit" class="btn btn-sm btn-outline-primary mb-2">{{ __('Points → Wallet') }}</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('wallet.convert-to-points') }}" class="form-inline">
                            @csrf
                            <input type="number" min="1" name="amount" class="form-control mr-2 mb-2" placeholder="{{ __('Taka') }}" style="width:120px;" required>
                            <button type="submit" class="btn btn-sm btn-outline-primary mb-2">{{ __('Wallet → Points') }}</button>
                        </form>
                    </div>
                </div>

                @if ($topupRequests->isNotEmpty())
                    <div class="acc-section-title"><h3>{{ __('Your Top-up Requests') }}</h3></div>
                    @foreach ($topupRequests as $tr)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>৳{{ number_format($tr->amount, 2) }}</strong> — {{ $tr->paymentMethod->name ?? '—' }}<br>
                                <span class="small">{{ $tr->created_at->format('d M Y, h:i A') }} · {{ __('Ref') }}: {{ $tr->payment_reference }}</span>
                            </div>
                            <div>
                                @if ($tr->status === 'pending')
                                    <span class="acc-badge acc-badge-warning">{{ __('Pending') }}</span>
                                @elseif ($tr->status === 'approved')
                                    <span class="acc-badge acc-badge-success">{{ __('Approved') }}</span>
                                @else
                                    <span class="acc-badge acc-badge-danger">{{ __('Rejected') }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif

                @if ($withdrawalRequests->isNotEmpty())
                    <div class="acc-section-title"><h3>{{ __('Your Withdrawal Requests') }}</h3></div>
                    @foreach ($withdrawalRequests as $wr)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>৳{{ number_format($wr->amount, 2) }}</strong> — {{ strtoupper($wr->method) }}<br>
                                <span class="small">{{ $wr->created_at->format('d M Y, h:i A') }} · {{ $wr->account_details }}</span>
                            </div>
                            <div>
                                @if ($wr->status === 'pending')
                                    <span class="acc-badge acc-badge-warning">{{ __('Pending') }}</span>
                                @elseif ($wr->status === 'approved')
                                    <span class="acc-badge acc-badge-success">{{ __('Approved') }}</span>
                                @else
                                    <span class="acc-badge acc-badge-danger">{{ __('Rejected') }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif

                @if ($walletTransactions->isNotEmpty())
                    <div class="acc-section-title"><h3>{{ __('Recent Wallet Activity') }}</h3></div>
                    @foreach ($walletTransactions as $tx)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>{{ $tx->description ?: ucfirst(str_replace('_', ' ', $tx->source)) }}</strong><br>
                                <span class="small">{{ $tx->created_at->format('d M Y, h:i A') }}</span>
                            </div>
                            <div>
                                <span class="{{ $tx->type === 'credit' ? 'text-success' : 'text-danger' }}" style="font-weight:700;">
                                    {{ $tx->type === 'credit' ? '+' : '−' }}৳{{ number_format($tx->amount, 2) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="acc-empty">{{ __('No wallet activity yet.') }}</div>
                @endif
            </div>

            {{-- CURRENCY EXCHANGE --}}
            <div class="tab-pane-acc" id="pane-currency">
                <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap:10px; margin-bottom: 4px;">
                    <h2 style="margin-bottom:0;">{{ __('Currency Exchange') }}</h2>
                    <div>
                        <a href="{{ route('currency.index') }}" class="btn btn-sm btn-outline-primary">{{ __('Browse Marketplace') }}</a>
                        <a href="{{ route('currency.create') }}" class="btn btn-sm" style="background: var(--brand-primary); color:#fff; font-weight:700;">{{ __('+ New Listing') }}</a>
                    </div>
                </div>
                <div class="acc-welcome">{{ __('Your own listings and purchases.') }}</div>

                <div class="acc-section-title"><h3>{{ __('My Listings') }}</h3></div>
                @if ($myListings->isEmpty())
                    <div class="acc-empty">{{ __("You haven't posted any listings yet.") }}</div>
                @else
                    @foreach ($myListings as $listing)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>{{ number_format($listing->amount_available, 2) }} {{ $listing->currency }}</strong> @ ৳{{ number_format($listing->rate, 2) }}<br>
                                <span class="small">{{ __('Remaining') }}: {{ number_format($listing->remaining(), 2) }} · {{ __('Sold') }}: {{ number_format($listing->amount_sold, 2) }}</span>
                            </div>
                            <div>
                                @if ($listing->status === 'active')
                                    <span class="acc-badge acc-badge-success">{{ __('Active') }}</span>
                                @elseif ($listing->status === 'paused')
                                    <span class="acc-badge acc-badge-warning">{{ __('Paused') }}</span>
                                @else
                                    <span class="acc-badge acc-badge-muted">{{ __('Closed') }}</span>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('currency.show', $listing->id) }}" class="btn btn-sm btn-outline-primary">{{ __('View') }}</a>
                                @if ($listing->status === 'active')
                                    <form method="POST" action="{{ route('currency.toggle', $listing->id) }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="paused">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">{{ __('Pause') }}</button>
                                    </form>
                                @elseif ($listing->status === 'paused')
                                    <form method="POST" action="{{ route('currency.toggle', $listing->id) }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="active">
                                        <button type="submit" class="btn btn-sm btn-outline-success">{{ __('Resume') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="acc-section-title"><h3>{{ __('My Purchases') }}</h3></div>
                @if ($myCurrencyOrders->isEmpty())
                    <div class="acc-empty">{{ __("You haven't bought any currency yet.") }}</div>
                @else
                    @foreach ($myCurrencyOrders as $co)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>{{ number_format($co->currency_amount, 2) }} {{ $co->currency }}</strong> — ৳{{ number_format($co->total_bdt, 2) }}<br>
                                <span class="small">{{ $co->created_at->format('d M Y, h:i A') }}</span>
                                @if ($co->seller_status === 'released')
                                    <br><span class="small text-success">{{ __('Seller marked this as sent.') }}</span>
                                @elseif ($co->seller_status === 'rejected')
                                    <br><span class="small text-danger">{{ __('Seller rejected') }}: {{ $co->seller_note }}</span>
                                @endif
                                @if ($co->buyer_confirmed_at)
                                    <br><span class="small text-success">{{ __('You confirmed receipt on') }} {{ $co->buyer_confirmed_at->format('d M Y') }}</span>
                                @endif
                            </div>
                            <div>
                                @if ($co->status === 'awaiting_payment')
                                    <span class="acc-badge acc-badge-warning">{{ __('Awaiting Payment') }}</span>
                                @elseif ($co->status === 'pending')
                                    <span class="acc-badge acc-badge-warning">{{ __('Pending Review') }}</span>
                                @elseif ($co->status === 'completed')
                                    <span class="acc-badge acc-badge-success">{{ __('Completed') }}</span>
                                @else
                                    <span class="acc-badge acc-badge-danger">{{ __('Rejected') }}</span>
                                @endif
                            </div>
                            <div>
                                @if ($co->status === 'awaiting_payment')
                                    <a href="{{ route('currency.payment', $co->id) }}" class="btn btn-sm" style="background: var(--brand-primary); color:#fff; font-weight:700;">{{ __('Pay Now') }}</a>
                                @endif
                                @if ($co->buyerCanConfirm())
                                    <form method="POST" action="{{ route('currency.buyer-confirm', $co->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm" style="background: var(--brand-success); color:#fff; font-weight:700;">{{ __('Confirm Received') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif

                @if ($myCurrencySales->isNotEmpty())
                    <div class="acc-section-title"><h3>{{ __('My Sales') }}</h3></div>
                    @foreach ($myCurrencySales as $cs)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>{{ number_format($cs->currency_amount, 2) }} {{ $cs->currency }}</strong> — ৳{{ number_format($cs->total_bdt, 2) }}<br>
                                <span class="small">{{ __('Buyer') }}: {{ $cs->buyer->name ?? '—' }} · {{ $cs->created_at->format('d M Y, h:i A') }}</span>
                                @if ($cs->sellerCanAct())
                                    <div class="mt-2" style="background:#f4f7fc; border:1px solid #e3e6ec; border-radius:8px; padding:10px 12px;">
                                        <strong class="small">{{ __('Send the currency to') }}:</strong>
                                        <div class="small" style="white-space:pre-line;">{{ $cs->receiving_details }}</div>
                                    </div>
                                @elseif ($cs->seller_status === 'rejected')
                                    <br><span class="small text-danger">{{ __('You rejected') }}: {{ $cs->seller_note }}</span>
                                @elseif ($cs->seller_status === 'released')
                                    <br><span class="small text-success">{{ __('Marked as sent') }}{{ $cs->buyer_confirmed_at ? ' · ' . __('buyer confirmed') : '' }}</span>
                                @endif
                            </div>
                            <div>
                                @if ($cs->sellerCanAct())
                                    <form method="POST" action="{{ route('currency.seller-release', $cs->id) }}" class="d-inline mb-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm" style="background: var(--brand-success); color:#fff; font-weight:700;">{{ __('Release') }}</button>
                                    </form>
                                    <form method="POST" action="{{ route('currency.seller-reject', $cs->id) }}" class="d-inline" onsubmit="return window.p2pAskReason(this);">
                                        @csrf
                                        <input type="hidden" name="reason" class="p2p-reason-input">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Reject') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- MARKETPLACE --}}
            <div class="tab-pane-acc" id="pane-marketplace">
                <div class="d-flex justify-content-between align-items-center flex-wrap" style="gap:10px; margin-bottom: 4px;">
                    <h2 style="margin-bottom:0;">{{ __('Marketplace') }}</h2>
                    <div>
                        <a href="{{ route('marketplace.index') }}" class="btn btn-sm btn-outline-primary">{{ __('Browse Marketplace') }}</a>
                        <a href="{{ route('marketplace.create') }}" class="btn btn-sm" style="background: var(--brand-primary); color:#fff; font-weight:700;">{{ __('+ New Listing') }}</a>
                    </div>
                </div>
                <div class="acc-welcome">{{ __('Your own listings, bids, and purchases.') }}</div>

                <div class="acc-section-title"><h3>{{ __('My Listings') }}</h3></div>
                @if ($myMarketListings->isEmpty())
                    <div class="acc-empty">{{ __("You haven't posted any listings yet.") }}</div>
                @else
                    @foreach ($myMarketListings as $ml)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>{{ $ml->title }}</strong> ({{ ucfirst($ml->listing_type) }})<br>
                                <span class="small">
                                    @if ($ml->listing_type === 'fixed')
                                        ৳{{ number_format($ml->price, 2) }} · {{ __('Remaining') }}: {{ $ml->remainingQuantity() }}
                                    @else
                                        {{ __('Current bid') }}: ৳{{ number_format($ml->current_bid ?: $ml->starting_price, 2) }}
                                    @endif
                                </span>
                            </div>
                            <div>
                                @if ($ml->status === 'active')
                                    <span class="acc-badge acc-badge-success">{{ __('Active') }}</span>
                                @elseif ($ml->status === 'sold')
                                    <span class="acc-badge acc-badge-success">{{ __('Sold') }}</span>
                                @elseif ($ml->status === 'expired')
                                    <span class="acc-badge acc-badge-muted">{{ __('Expired') }}</span>
                                @elseif ($ml->status === 'paused')
                                    <span class="acc-badge acc-badge-warning">{{ __('Paused') }}</span>
                                @else
                                    <span class="acc-badge acc-badge-muted">{{ __('Closed') }}</span>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('marketplace.show', $ml->id) }}" class="btn btn-sm btn-outline-primary">{{ __('View') }}</a>
                                @if ($ml->listing_type === 'fixed' && $ml->status === 'active')
                                    <form method="POST" action="{{ route('marketplace.toggle', $ml->id) }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="paused">
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">{{ __('Pause') }}</button>
                                    </form>
                                @elseif ($ml->listing_type === 'fixed' && $ml->status === 'paused')
                                    <form method="POST" action="{{ route('marketplace.toggle', $ml->id) }}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="active">
                                        <button type="submit" class="btn btn-sm btn-outline-success">{{ __('Resume') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="acc-section-title"><h3>{{ __('My Purchases') }}</h3></div>
                @if ($myMarketOrders->isEmpty())
                    <div class="acc-empty">{{ __("You haven't bought anything yet.") }}</div>
                @else
                    @foreach ($myMarketOrders as $mo)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>{{ $mo->listing->title ?? '—' }}</strong> × {{ $mo->quantity }}<br>
                                <span class="small">৳{{ number_format($mo->amount, 2) }} · {{ $mo->created_at->format('d M Y') }}</span>
                                @if ($mo->seller_status === 'released')
                                    <br><span class="small text-success">{{ __('Seller marked this as sent.') }}</span>
                                @elseif ($mo->seller_status === 'rejected')
                                    <br><span class="small text-danger">{{ __('Seller rejected') }}: {{ $mo->seller_note }}</span>
                                @endif
                                @if ($mo->buyer_confirmed_at)
                                    <br><span class="small text-success">{{ __('You confirmed receipt on') }} {{ $mo->buyer_confirmed_at->format('d M Y') }}</span>
                                @endif
                            </div>
                            <div>
                                @if ($mo->status === 'awaiting_payment')
                                    <span class="acc-badge acc-badge-warning">{{ __('Awaiting Payment') }}</span>
                                @elseif ($mo->status === 'pending')
                                    <span class="acc-badge acc-badge-warning">{{ __('Pending Review') }}</span>
                                @elseif ($mo->status === 'completed')
                                    <span class="acc-badge acc-badge-success">{{ __('Completed') }}</span>
                                @else
                                    <span class="acc-badge acc-badge-danger">{{ __('Rejected') }}</span>
                                @endif
                            </div>
                            <div>
                                @if ($mo->status === 'awaiting_payment')
                                    <a href="{{ route('marketplace.payment', $mo->id) }}" class="btn btn-sm" style="background: var(--brand-primary); color:#fff; font-weight:700;">{{ __('Pay Now') }}</a>
                                @elseif ($mo->status === 'completed' && $mo->listing && $mo->listing->isDigital())
                                    @if ($mo->listing->digital_link)
                                        <a href="{{ $mo->listing->digital_link }}" target="_blank" class="btn btn-sm btn-outline-primary">{{ __('Open Link') }}</a>
                                    @elseif ($mo->listing->digitalFile)
                                        <a href="/public/images/media/{{ $mo->listing->digitalFile->file }}" target="_blank" class="btn btn-sm btn-outline-primary">{{ __('Download') }}</a>
                                    @endif
                                @endif
                                @if ($mo->buyerCanConfirm())
                                    <form method="POST" action="{{ route('marketplace.buyer-confirm', $mo->id) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm" style="background: var(--brand-success); color:#fff; font-weight:700;">{{ __('Confirm Received') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif

                @if ($myMarketSales->isNotEmpty())
                    <div class="acc-section-title"><h3>{{ __('My Sales') }}</h3></div>
                    @foreach ($myMarketSales as $ms)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>{{ $ms->listing->title ?? '—' }}</strong> × {{ $ms->quantity }}<br>
                                <span class="small">{{ __('Buyer') }}: {{ $ms->buyer->name ?? '—' }} · ৳{{ number_format($ms->amount, 2) }} · {{ $ms->created_at->format('d M Y') }}</span>
                                @if ($ms->sellerCanAct())
                                    <div class="mt-2" style="background:#f4f7fc; border:1px solid #e3e6ec; border-radius:8px; padding:10px 12px;">
                                        <strong class="small">{{ __('Deliver to') }}:</strong>
                                        <div class="small" style="white-space:pre-line;">{{ $ms->receiving_details }}</div>
                                    </div>
                                @elseif ($ms->seller_status === 'rejected')
                                    <br><span class="small text-danger">{{ __('You rejected') }}: {{ $ms->seller_note }}</span>
                                @elseif ($ms->seller_status === 'released')
                                    <br><span class="small text-success">{{ __('Marked as sent') }}{{ $ms->buyer_confirmed_at ? ' · ' . __('buyer confirmed') : '' }}</span>
                                @endif
                            </div>
                            <div>
                                @if ($ms->sellerCanAct())
                                    <form method="POST" action="{{ route('marketplace.seller-release', $ms->id) }}" class="d-inline mb-1">
                                        @csrf
                                        <button type="submit" class="btn btn-sm" style="background: var(--brand-success); color:#fff; font-weight:700;">{{ __('Release') }}</button>
                                    </form>
                                    <form method="POST" action="{{ route('marketplace.seller-reject', $ms->id) }}" class="d-inline" onsubmit="return window.p2pAskReason(this);">
                                        @csrf
                                        <input type="hidden" name="reason" class="p2p-reason-input">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Reject') }}</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- POINTS --}}
            <div class="tab-pane-acc" id="pane-points">
                <h2>{{ __('My Points') }}</h2>
                <div class="acc-welcome">{{ __('Points you earn by winning mini games.') }}</div>

                <div class="acc-stats">
                    <div class="acc-stat-card">
                        <div class="acc-stat-icon c-primary"><i class="fas fa-coins"></i></div>
                        <div class="acc-stat-num">{{ number_format((int) $user->points) }}</div>
                        <div class="acc-stat-label">{{ __('Total Points') }}</div>
                    </div>
                    <div class="acc-stat-card">
                        <div class="acc-stat-icon c-success"><i class="fas fa-trophy"></i></div>
                        <div class="acc-stat-num">{{ $gameStats['wins'] }}</div>
                        <div class="acc-stat-label">{{ __('Games Won') }}</div>
                    </div>
                    <div class="acc-stat-card">
                        <div class="acc-stat-icon c-accent"><i class="fas fa-gamepad"></i></div>
                        <div class="acc-stat-num">{{ $gameStats['plays'] }}</div>
                        <div class="acc-stat-label">{{ __('Games Played') }}</div>
                    </div>
                </div>

                <div class="mb-3"><a href="{{ route('games.index') }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-gamepad"></i> {{ __('Play Mini Games') }}</a></div>

                <div class="acc-section-title"><h3>{{ __('Recent Games') }}</h3></div>
                @if ($gamePlays->isEmpty())
                    <div class="acc-empty">{{ __('You have not played any mini games yet.') }}</div>
                @else
                    @foreach ($gamePlays as $play)
                        <div class="acc-row">
                            <div class="acc-row-main">
                                <strong>{{ \App\Models\GameSetting::$games[$play->game_key]['name'] ?? $play->game_key }}</strong><br>
                                <span class="small">{{ optional($play->completed_at)->format('d M Y, h:i A') }}</span>
                            </div>
                            <div>
                                @if ($play->is_win)
                                    <span class="acc-badge acc-badge-success">{{ __('Won') }}</span>
                                @else
                                    <span class="acc-badge acc-badge-muted">{{ __('Lost') }}</span>
                                @endif
                            </div>
                            <div>{{ $play->netPoints() > 0 ? '+' . $play->netPoints() : $play->netPoints() }} {{ __('pts') }}</div>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- NOTEPAD --}}
            <div class="tab-pane-acc" id="pane-notepad">
                <h2>{{ __('My Notepad') }}</h2>
                <p class="acc-welcome">{{ __('These notes are private. They are never shown on the website — only you can see and edit them.') }}</p>

                <div class="mb-3" style="position: relative;">
                    <i class="fas fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #9099a8;"></i>
                    <input type="text" id="noteSearch" class="form-control" placeholder="{{ __('Search your notes...') }}" style="padding-left: 38px; border-radius: 24px; background: #fafcff; border: 1.5px solid #eef2f8;">
                </div>

                <div id="noteComposer" class="mb-4" style="border-radius: 10px; border: 1.5px solid #eef2f8; background: #fafcff; padding: 12px 16px;">
                    <input type="text" id="newNoteTitle" class="form-control mb-2 border-0 p-0" placeholder="{{ __('Title') }}" style="background: transparent; font-weight: 600; display: none;">
                    <textarea id="newNoteContent" class="form-control border-0 p-0" rows="1" placeholder="{{ __('Take a note...') }}" style="background: transparent; resize: none;"></textarea>
                    <div id="composerActions" class="text-right mt-2" style="display: none;">
                        <button type="button" id="cancelNoteBtn" class="btn btn-sm btn-light">{{ __('Cancel') }}</button>
                        <button type="button" id="saveNoteBtn" class="btn btn-sm" style="background: var(--brand-primary); color:#fff; font-weight:700;">{{ __('Save') }}</button>
                    </div>
                </div>

                <div id="noNotesMsg" class="acc-empty" style="{{ $notes->count() ? 'display:none;' : '' }}">
                    {{ __('No notes yet — write your first one above.') }}
                </div>

                <div id="notesGrid">
                    @foreach ($notes as $note)
                        <div class="note-card" data-id="{{ $note->id }}"
                             data-search="{{ strtolower($note->title . ' ' . $note->content) }}"
                             style="break-inside: avoid; margin-bottom: 14px; border-radius: 10px; border: 1.5px solid #eef2f8; background: #fafcff; padding: 14px 16px; position: relative;">

                            <div class="note-view">
                                @if ($note->title)
                                    <div class="font-weight-bold mb-1 note-title-view">{{ $note->title }}</div>
                                @endif
                                <div class="note-content-view" style="white-space: pre-wrap; word-break: break-word;">{{ $note->content }}</div>

                                <div class="text-right mt-2">
                                    <button type="button" class="btn btn-sm btn-link p-0 mr-3 edit-note-btn" title="{{ __('Edit') }}"><i class="fas fa-pen"></i></button>
                                    <button type="button" class="btn btn-sm btn-link p-0 text-danger delete-note-btn" title="{{ __('Delete') }}"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>

                            <div class="note-edit" style="display: none;">
                                <input type="text" class="form-control form-control-sm mb-2 edit-note-title" value="{{ $note->title }}" placeholder="{{ __('Title') }}">
                                <textarea class="form-control form-control-sm edit-note-content" rows="4">{{ $note->content }}</textarea>
                                <div class="text-right mt-2">
                                    <button type="button" class="btn btn-sm btn-light cancel-edit-btn">{{ __('Cancel') }}</button>
                                    <button type="button" class="btn btn-sm btn-primary save-edit-btn">{{ __('Save') }}</button>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ACCOUNT INFO --}}
            <div class="tab-pane-acc" id="pane-account">
                <h2>{{ __('Account Info') }}</h2>
                <div class="acc-welcome">{{ __('Edit your name, phone, city and address. Changes are reviewed by an admin before they apply.') }}</div>

                @if (session('profile_success'))
                    <div class="alert alert-success">{{ session('profile_success') }}</div>
                @endif
                @if (session('profile_info'))
                    <div class="alert alert-info">{{ session('profile_info') }}</div>
                @endif

                @if ($pendingRequest)
                    <div class="acc-pending-notice">
                        <i class="fas fa-clock"></i>
                        {{ __('You have a change request awaiting admin approval:') }}
                        <ul class="mb-0 mt-1">
                            @if ($pendingRequest->name)<li>{{ __('Name') }} → {{ $pendingRequest->name }}</li>@endif
                            @if ($pendingRequest->phone)<li>{{ __('Phone') }} → {{ $pendingRequest->phone }}</li>@endif
                            @if ($pendingRequest->city)<li>{{ __('City') }} → {{ $pendingRequest->city }}</li>@endif
                            @if ($pendingRequest->address)<li>{{ __('Address') }} → {{ $pendingRequest->address }}</li>@endif
                            @if ($pendingRequest->photo_id)<li>{{ __('New profile photo') }}</li>@endif
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update-request') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="acc-photo-row">
                        <img src="{{ $user->photo ? '/public/images/media/' . $user->photo->file : '/public/img/200x200.png' }}" alt="" class="acc-photo-preview" id="accPhotoPreview">
                        <div>
                            <label for="accPhotoInput" class="btn btn-sm" style="background: var(--brand-primary); color:#fff; font-weight:700; cursor:pointer;">{{ __('Change Photo') }}</label>
                            <input type="file" id="accPhotoInput" name="photo" accept="image/*" style="display:none;">
                            <div class="small text-muted mt-1">{{ __('JPG or PNG, up to 4MB.') }}</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group acc-form-group">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group acc-form-group">
                                <label>{{ __('E-Mail Address') }}</label>
                                <input type="text" value="{{ $user->email }}" class="form-control acc-readonly" readonly>
                                <div class="small text-muted mt-1">{{ __("Email can't be changed here.") }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group acc-form-group">
                                <label>{{ __('Phone') }}</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group acc-form-group">
                                <label>{{ __('City') }}</label>
                                <input type="text" name="city" value="{{ old('city', $user->city) }}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group acc-form-group">
                                <label>{{ __('Shopping Address') }}</label>
                                <textarea name="address" rows="2" class="form-control">{{ old('address', $user->address) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn" style="background: var(--brand-primary); color:#fff; font-weight:700;">{{ __('Submit for Review') }}</button>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')
<script>
    // Shared by the currency/marketplace "Reject" seller buttons — prompts
    // for the rejection reason and fills the form's hidden input before
    // letting it submit. Global (not inside DOMContentLoaded) since it's
    // called directly from inline onsubmit handlers.
    window.p2pAskReason = function (form) {
        var reason = prompt('{{ __("Why are you rejecting this order?") }}');
        if (!reason || !reason.trim()) { return false; }
        form.querySelector('.p2p-reason-input').value = reason.trim();
        return true;
    };

document.addEventListener('DOMContentLoaded', function () {
    // ----- Account photo live preview -----
    var photoInput = document.getElementById('accPhotoInput');
    var photoPreview = document.getElementById('accPhotoPreview');
    if (photoInput && photoPreview) {
        photoInput.addEventListener('change', function () {
            var file = photoInput.files && photoInput.files[0];
            if (!file) { return; }
            var reader = new FileReader();
            reader.onload = function (e) { photoPreview.src = e.target.result; };
            reader.readAsDataURL(file);
        });
    }

    // ----- Tab switching -----
    var navLinks = document.querySelectorAll('#accNav a[data-tab]');
    var tabLinksInline = document.querySelectorAll('.acc-tab-link[data-tab]');
    var panes = document.querySelectorAll('.tab-pane-acc');

    function activateTab(tab) {
        if (!document.getElementById('pane-' + tab)) { tab = 'overview'; }
        navLinks.forEach(function (l) {
            l.classList.toggle('active', l.dataset.tab === tab);
        });
        panes.forEach(function (p) {
            p.classList.toggle('active', p.id === 'pane-' + tab);
        });
    }

    navLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var tab = this.dataset.tab;
            history.replaceState(null, '', '#' + tab);
            activateTab(tab);
        });
    });

    tabLinksInline.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var tab = this.dataset.tab;
            history.replaceState(null, '', '#' + tab);
            activateTab(tab);
        });
    });

    var urlParams = new URLSearchParams(window.location.search);
    var initialTab = (window.location.hash || '').replace('#', '') || urlParams.get('tab') || 'overview';
    activateTab(initialTab);

    // ----- Notepad -----
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const grid = document.getElementById('notesGrid');
    const noNotesMsg = document.getElementById('noNotesMsg');

    function apiFetch(url, method, body) {
        return fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: body ? JSON.stringify(body) : undefined,
        }).then(function (res) {
            if (!res.ok) { throw new Error('Request failed'); }
            return res.json();
        });
    }

    function updateEmptyState() {
        var hasCards = grid.querySelectorAll('.note-card').length > 0;
        noNotesMsg.style.display = hasCards ? 'none' : 'block';
    }

    function buildCard(note) {
        var card = document.createElement('div');
        card.className = 'note-card';
        card.dataset.id = note.id;
        card.dataset.search = ((note.title || '') + ' ' + (note.content || '')).toLowerCase();
        card.style.breakInside = 'avoid';
        card.style.marginBottom = '14px';
        card.style.borderRadius = '10px';
        card.style.border = '1.5px solid #eef2f8';
        card.style.background = '#fafcff';
        card.style.padding = '14px 16px';
        card.style.position = 'relative';

        card.innerHTML =
            '<div class="note-view">' +
                (note.title ? '<div class="font-weight-bold mb-1 note-title-view"></div>' : '') +
                '<div class="note-content-view" style="white-space: pre-wrap; word-break: break-word;"></div>' +
                '<div class="text-right mt-2">' +
                    '<button type="button" class="btn btn-sm btn-link p-0 mr-3 edit-note-btn" title="{{ __('Edit') }}"><i class="fas fa-pen"></i></button>' +
                    '<button type="button" class="btn btn-sm btn-link p-0 text-danger delete-note-btn" title="{{ __('Delete') }}"><i class="fas fa-trash"></i></button>' +
                '</div>' +
            '</div>' +
            '<div class="note-edit" style="display: none;">' +
                '<input type="text" class="form-control form-control-sm mb-2 edit-note-title" placeholder="{{ __('Title') }}">' +
                '<textarea class="form-control form-control-sm edit-note-content" rows="4"></textarea>' +
                '<div class="text-right mt-2">' +
                    '<button type="button" class="btn btn-sm btn-light cancel-edit-btn">{{ __('Cancel') }}</button>' +
                    '<button type="button" class="btn btn-sm btn-primary save-edit-btn">{{ __('Save') }}</button>' +
                '</div>' +
            '</div>';

        if (note.title) {
            card.querySelector('.note-title-view').textContent = note.title;
        }
        card.querySelector('.note-content-view').textContent = note.content || '';
        card.querySelector('.edit-note-title').value = note.title || '';
        card.querySelector('.edit-note-content').value = note.content || '';

        return card;
    }

    var titleInput = document.getElementById('newNoteTitle');
    var contentInput = document.getElementById('newNoteContent');
    var actions = document.getElementById('composerActions');

    contentInput.addEventListener('focus', function () {
        titleInput.style.display = 'block';
        actions.style.display = 'block';
    });

    document.getElementById('cancelNoteBtn').addEventListener('click', function () {
        titleInput.value = '';
        contentInput.value = '';
        titleInput.style.display = 'none';
        actions.style.display = 'none';
    });

    document.getElementById('saveNoteBtn').addEventListener('click', function () {
        var title = titleInput.value.trim();
        var content = contentInput.value.trim();
        if (!title && !content) { return; }

        apiFetch("{{ route('notes.store') }}", 'POST', { title: title, content: content })
            .then(function (data) {
                var card = buildCard(data.note);
                grid.insertBefore(card, grid.firstChild);
                titleInput.value = '';
                contentInput.value = '';
                titleInput.style.display = 'none';
                actions.style.display = 'none';
                updateEmptyState();
            })
            .catch(function () { alert('Could not save the note. Please try again.'); });
    });

    document.getElementById('noteSearch').addEventListener('input', function (e) {
        var q = e.target.value.trim().toLowerCase();
        grid.querySelectorAll('.note-card').forEach(function (card) {
            card.style.display = card.dataset.search.indexOf(q) !== -1 ? '' : 'none';
        });
    });

    grid.addEventListener('click', function (e) {
        var card = e.target.closest('.note-card');
        if (!card) { return; }
        var id = card.dataset.id;

        if (e.target.closest('.edit-note-btn')) {
            card.querySelector('.note-view').style.display = 'none';
            card.querySelector('.note-edit').style.display = 'block';
        }

        if (e.target.closest('.cancel-edit-btn')) {
            card.querySelector('.note-edit').style.display = 'none';
            card.querySelector('.note-view').style.display = 'block';
        }

        if (e.target.closest('.delete-note-btn')) {
            if (!confirm('{{ __('Delete this note?') }}')) { return; }
            apiFetch('/notes/' + id, 'DELETE')
                .then(function () {
                    card.remove();
                    updateEmptyState();
                })
                .catch(function () { alert('Could not delete the note. Please try again.'); });
        }

        if (e.target.closest('.save-edit-btn')) {
            var title = card.querySelector('.edit-note-title').value.trim();
            var content = card.querySelector('.edit-note-content').value.trim();

            apiFetch('/notes/' + id, 'PUT', { title: title, content: content })
                .then(function (data) {
                    var titleEl = card.querySelector('.note-title-view');
                    if (data.note.title) {
                        if (!titleEl) {
                            titleEl = document.createElement('div');
                            titleEl.className = 'font-weight-bold mb-1 note-title-view';
                            card.querySelector('.note-view').prepend(titleEl);
                        }
                        titleEl.textContent = data.note.title;
                    } else if (titleEl) {
                        titleEl.remove();
                    }
                    card.querySelector('.note-content-view').textContent = data.note.content || '';
                    card.dataset.search = ((data.note.title || '') + ' ' + (data.note.content || '')).toLowerCase();

                    card.querySelector('.note-edit').style.display = 'none';
                    card.querySelector('.note-view').style.display = 'block';
                })
                .catch(function () { alert('Could not save changes. Please try again.'); });
        }
    });
});
</script>
<script>
(function () {
    // Every list in this page (Orders, Return Orders, Digital Products, My Donations,
    // Wallet Activity, Currency listings/orders, Marketplace listings/orders, My Points)
    // is a run of .acc-row elements directly inside a .tab-pane-acc. Paginate any of
    // them that has more than PER_PAGE rows - lists that are already short are left
    // exactly as they are.
    var PER_PAGE = 7;

    document.querySelectorAll('.tab-pane-acc').forEach(function (pane) {
        var rows = Array.prototype.slice.call(pane.querySelectorAll(':scope > .acc-row'));
        if (rows.length <= PER_PAGE) { return; }

        var pageCount = Math.ceil(rows.length / PER_PAGE);
        var current = 1;

        var pager = document.createElement('div');
        pager.className = 'acc-pager';
        pane.appendChild(pager);

        function show(p) {
            current = Math.min(Math.max(1, p), pageCount);
            rows.forEach(function (row, i) {
                row.style.display = (i >= (current - 1) * PER_PAGE && i < current * PER_PAGE) ? '' : 'none';
            });
            renderPager();
        }

        function button(label, page, opts) {
            opts = opts || {};
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'acc-pager-btn' + (opts.active ? ' active' : '');
            btn.textContent = label;
            btn.disabled = !!opts.disabled;
            btn.addEventListener('click', function () { show(page); });
            return btn;
        }

        function renderPager() {
            pager.innerHTML = '';
            pager.appendChild(button('\u00AB', current - 1, { disabled: current === 1 }));
            for (var i = 1; i <= pageCount; i++) {
                pager.appendChild(button(String(i), i, { active: i === current }));
            }
            pager.appendChild(button('\u00BB', current + 1, { disabled: current === pageCount }));
        }

        show(1);
    });
})();
</script>
@endsection
