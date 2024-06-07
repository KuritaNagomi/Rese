@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css')}}">
@endsection

@section('content')
<div class="register-form">
    <div class="register-form__box">
        <h2 class="register-form__heading">Registration</h2>
        <div class="register-form__inner">
            <form action="/register" method="post" class="register-form__form">
                @csrf
                <div class="register-form__group">
                    <div class="input__group">
                        <span class="icon"><img class="img" src="{{ asset('img/users.png') }}" alt="icon"></span>
                        <input class="register-form__input" type="text" name="name" id="name" placeholder="Username" value="{{ old('name') }}">
                    </div>
                    <p class="register-form__error-message">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="register-form__group">
                    <div class="input__group">
                        <span class="icon"><img class="img" src="{{ asset('img/email.png') }}" alt="icon"></span>
                        <input class="register-form__input" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <p class="register-form__error-message">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </p>
                </div>
                <div class="register-form__group">
                    <div class="input__group">
                        <span class="icon"><img class="img" src="{{ asset('img/password.png') }}" alt="icon"></span>
                        <input class="register-form__input" type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <p class="register-form__error-message">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </p>
                </div>
                <div class="register">
                    <input type="submit" class="register-form__btn" value="登録">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')