@extends('layouts.login-screens')
@section('content')
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="login-form-head">
                        <h4>{{ 'Sign In' }}</h4>
                        <p>{{ 'Hello there, Sign in and start managing your website' }}</p>
                    </div>
                    @include('backend.partials.message')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="username">{{ 'Username' }}</label>
                            <input type="text" id="username" name="username">
                            <i class="ti-email"></i>
                        </div>
                        <div class="form-gp">
                            <label for="password">{{ 'Password' }}</label>
                            <input type="password" id="password" name="password">
                            <i class="ti-lock"></i>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                    <label class="custom-control-label" for="remember">{{ 'Remember Me' }}</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('admin.forget.password') }}">{{ 'Forgot Password?' }}</a>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">{{ 'Login' }} <i
                                    class="ti-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
