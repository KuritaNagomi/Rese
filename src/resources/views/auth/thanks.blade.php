@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css')}}">
@endsection

@section('content')
<div class="registerd">
    <div class="message__box">
        <div class="box__inner">
            <p class="message">会員登録ありがとうございます</p>
            <div class="login">
                <a href="/login" class="login-btn">ログインする</a>
            </div>
        </div>
    </div>
</div>
@endsection('content')