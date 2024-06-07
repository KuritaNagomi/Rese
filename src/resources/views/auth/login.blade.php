@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css')}}">
@endsection

@section('content')
<div class="login-form">
    <div class="login-form__box">
        <h2 class="login-form__heading">Login</h2>
        <div class="login-form__inner">
            <form action="/login" method="post" class="login-form__form">
                @csrf
                <div class="login-form__group">
                    <div class="input__group">
                        <span class="icon"><img class="img" src="{{ asset('img/email.png') }}" alt="icon"></span>
                        <input class="login-form__input" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <p class="login-form__error-message">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="login-form__group">
                    <div class="input__group">
                        <span class="icon"><img class="img" src="{{ asset('img/password.png') }}" alt="icon"></span>
                        <input class="login-form__input" type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <p class="login-form__error-message">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="login">
                    <input type="submit" class="login-form__btn" value="ログイン">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')