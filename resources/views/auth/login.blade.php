@extends('layouts.auth')

@section('content')
<div class="">
<div class="auth-layout-wrap" >
    <div class="auth-content d-flex flex-items-center justify-content-center" >
        <div class="card o-hidden col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-4">
                        <div style="font-size:25px; " class="border-bottom border-dark auth-logo text-center text-grey font-weight-bold mb-4">Admin Login</div>
                        <!-- <h1 class="mb-3 text-18 text-center">SIGN IN</h1> -->
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input class="form-control form-control-rounded @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">{{ __('Password') }}</label>
                                <input class="form-control form-control-rounded @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div> -->
                                    <button type="submit" class="form-control btn btn-gray-800 btn-block mt-3">Sign in</button>
                        </form>
                        <!-- @if (Route::has('password.request'))
                        <div class="mt-3 text-center"><a class="text-muted" href="{{ route('password.request') }}">
                                <u>{{ __('Forgot Your Password?') }}</u></a></div>
                         @endif -->
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>
@endsection
