@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css')}}">
@endsection

@section('content')
<div class="done">
    <div class="message__box">
        <div class="box__inner">
            <p class="message">ご予約ありがとうございます</p>
            <div class="back">
                <a href="/" class="back-btn">戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection('content')