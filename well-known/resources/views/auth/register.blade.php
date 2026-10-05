@extends('layouts.auth')

@section('content')



<div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5 mx-auto" style="max-width: 550px;">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ __('Register') }}</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-12">

                                        <input id="name" type="text" placeholder="{{ __('Name') }}" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <select name="country_code" class="@error('country_code') is-invalid @enderror" style="width: 110px; height: 100%; padding: 0.5rem 1.5rem 0.5rem 0.75rem; font-size: 0.8rem; color: #6e707e; background-color: #fff; border: 1px solid #d1d3e2; border-right: none; border-top-left-radius: 10rem; border-bottom-left-radius: 10rem; border-top-right-radius: 0; border-bottom-right-radius: 0; -webkit-appearance: menulist; appearance: menulist;">
                                                <option value="+880" selected>BD +880</option>
                                                <option value="+91">IN +91</option>
                                                <option value="+92">PK +92</option>
                                                <option value="+1">US +1</option>
                                                <option value="+44">GB +44</option>
                                                <option value="+971">AE +971</option>
                                                <option value="+966">SA +966</option>
                                                <option value="+974">QA +974</option>
                                                <option value="+965">KW +965</option>
                                                <option value="+968">OM +968</option>
                                                <option value="+973">BH +973</option>
                                                <option value="+60">MY +60</option>
                                                <option value="+65">SG +65</option>
                                                <option value="+86">CN +86</option>
                                                <option value="+61">AU +61</option>
                                                <option value="+49">DE +49</option>
                                                <option value="+33">FR +33</option>
                                                <option value="+39">IT +39</option>
                                                <option value="+7">RU +7</option>
                                                <option value="+81">JP +81</option>
                                                <option value="+82">KR +82</option>
                                                <option value="+977">NP +977</option>
                                                <option value="+94">LK +94</option>
                                                <option value="+95">MM +95</option>
                                                <option value="+20">EG +20</option>
                                                <option value="+234">NG +234</option>
                                                <option value="+27">ZA +27</option>
                                                <option value="+55">BR +55</option>
                                                <option value="+90">TR +90</option>
                                                <option value="+62">ID +62</option>
                                                <option value="+63">PH +63</option>
                                                <option value="+66">TH +66</option>
                                                <option value="+84">VN +84</option>
                                            </select>
                                        </div>
                                        <input id="phone" type="tel" placeholder="{{ __('Mobile Number') }}" class="form-control form-control-user @error('phone') is-invalid @enderror" style="border-top-left-radius:0; border-bottom-left-radius:0;" name="phone" value="{{ old('phone') }}" required autocomplete="tel">

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @error('country_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        
                                        <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="col-sm-6">
                                        <input id="password-confirm" type="password" class="form-control form-control-user" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required autocomplete="new-password"> 
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Register') }}
                                </button>
                                <hr>
                                <a  href="{{ url('auth/facebook') }}" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> {{clean( trans('niva-backend.register_facebook') , array('Attr.EnableID' => true))}}
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                               @if (Route::has('password.request'))
                                    <a class="small" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}</a>
                                @endif
                            </div>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">{{clean( trans('niva-backend.already_acc') , array('Attr.EnableID' => true))}}</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
