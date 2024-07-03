@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/email.css')}}">
@endsection

@section('content')
<div class="send_email">
    <h2 class="email__heading">メール送信フォーム</h2>
    <div class="send_email-box">
        <form action="{{ route('send_email',  ['userId' => $user->id]) }}" method="post" >
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="form-group">
                <label for="email" class="label">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="subject" class="label">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" >
            </div>
            <div class="form-group">
                <label for="message" class="label">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control" ></textarea>
            </div>
            <div class="send-btn">
                <button type="submit" class="btn">メール送信</button>
            </div>
        </form>
    </div>
</div>
@endsection('content')