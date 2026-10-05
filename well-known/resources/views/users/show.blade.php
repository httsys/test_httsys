@extends('layouts.admin')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$user->name}}</h6>
        </div>
        <div class="card-body">

                <a href="{{ route('users.index') }}" class="btn btn-primary btn-back">{{clean( trans('niva-backend.back_user') , array('Attr.EnableID' => true))}}</a>

                <div class="row">
                    <div class="col-md-3">
                        <div class="img-container">
                            <img class="img-fluid" src="/public/images/media/{{$user->photo ? $user->photo->file : '/public/img/200x200.png'}}" alt="">
                        </div>
                    </div>
                    <div class="col-md-9">

                        <form>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{clean( trans('niva-backend.name') , array('Attr.EnableID' => true))}}</strong>
                                        <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="{{clean( trans('niva-backend.name') , array('Attr.EnableID' => true))}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{clean( trans('niva-backend.email') , array('Attr.EnableID' => true))}}</strong>
                                        <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="{{clean( trans('niva-backend.email') , array('Attr.EnableID' => true))}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{clean( trans('niva-backend.address') , array('Attr.EnableID' => true))}}</strong>
                                        <input type="text" name="address" value="{{$user->address}}" class="form-control" placeholder="{{clean( trans('niva-backend.address') , array('Attr.EnableID' => true))}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{clean( trans('niva-backend.city') , array('Attr.EnableID' => true))}}</strong>
                                        <input type="text" name="city" value="{{$user->city}}" class="form-control" placeholder="{{clean( trans('niva-backend.city') , array('Attr.EnableID' => true))}}" readonly="">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>{{clean( trans('niva-backend.phone') , array('Attr.EnableID' => true))}}</strong>
                                        <input type="text" name="phone" value="{{$user->phone}}" class="form-control" placeholder="{{clean( trans('niva-backend.phone') , array('Attr.EnableID' => true))}}" readonly="">
                                    </div>
                                </div>
                            </div>

                        </form>
                        
                    </div>
                </div>

                <hr>

                <h6 class="font-weight-bold text-primary">Email Verification</h6>

                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="name" value="{{ $user->name }}">
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <input type="hidden" name="role_id" value="{{ $user->role_id }}">
                            <input type="hidden" name="address" value="{{ $user->address }}">
                            <input type="hidden" name="city" value="{{ $user->city }}">
                            <input type="hidden" name="phone" value="{{ $user->phone }}">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="email_verification_override" name="email_verification_override" value="1" {{ $user->email_verification_override ? 'checked' : '' }} onchange="this.form.submit()">
                                <label class="custom-control-label" for="email_verification_override">{{ $user->email_verification_override ? 'On' : 'Off' }}</label>
                            </div>
                            <p class="text-muted small mb-0">এই সেটিং অন করা থাকলে এই ইউজার ভেরিফিকেশন কোড ছাড়াই (বা কোড ভুল দিলেও) লগইন করতে পারবেন।</p>
                        </form>
                    </div>
                </div>

                <hr>

                <h6 class="font-weight-bold text-primary">Login History</h6>

                <div class="row mb-3">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Last Login At</strong>
                            <input type="text" value="{{ $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i:s') : '—' }}" class="form-control" readonly="">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Last Login IP</strong>
                            <input type="text" value="{{ $user->last_login_ip ?? '—' }}" class="form-control" readonly="">
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date &amp; Time</th>
                                <th>IP Address</th>
                                <th>Device / Browser</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($loginLogs as $log)
                                <tr>
                                    <td>{{ $log->logged_in_at ? $log->logged_in_at->format('Y-m-d H:i:s') : $log->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $log->ip_address }}</td>
                                    <td>{{ $log->user_agent ?? '—' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No login history yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->




@endsection