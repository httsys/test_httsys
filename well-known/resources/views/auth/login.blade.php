@extends('layouts.auth')

@section('content')

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-8 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5" style="background: rgba(255, 255, 255, 0.55); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.6); border-radius: 16px;">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{clean( trans('niva-backend.welcome_back') , array('Attr.EnableID' => true))}}</h1>
                                </div>

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                 <form method="POST" action="{{ route('login') }}" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="{{ __('E-Mail Address') }}" autofocus style="background: rgba(255,255,255,0.7); border: 1.5px solid rgba(120,130,150,0.35);">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" placeholder="{{ __('Password') }}" type="password" id="exampleInputPassword"  class="form-control form-control-user @error('password') is-invalid @enderror" name="password" value="" required autocomplete="current-password" style="background: rgba(255,255,255,0.7); border: 1.5px solid rgba(120,130,150,0.35);">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">

                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>

                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        {{ __('Login') }}
                                    </button>

                                    <hr>
        
                                    <a  href="{{ url('auth/facebook') }}" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i>{{clean( trans('niva-backend.login_facebook') , array('Attr.EnableID' => true))}}
                                    </a>

                                </form>
                                <hr>
                                <div class="text-center">
                                    @if (Route::has('password.request'))
                                        <a class="small" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}</a>
                                    @endif
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{ route('register') }}">{{clean( trans('niva-backend.create_acc') , array('Attr.EnableID' => true))}}</a>
                                </div>
                            
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>




@endsection
