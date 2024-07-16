@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment.css')}}">
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <h4>エラーが発生しました:</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @if ($errors->has('詳細'))
            <p>詳細:</p>
            <pre>{{ $errors->first('詳細') }}</pre>
        @endif
    </div>
@endif
<div class="payment-form">
    <div class="payment-form__box">
        <h2 class="payment-form__heading">ご登録のカードで支払い</h2>
        <div class="payment-form__inner">
            <form action="{{ route('payment.charge') }}" method="post">
                @csrf
                <div class="form__group">
                    <p class="form__input">金額：</p>
                    <input class="form__input" type="number" name="amount" id="amount" required>円
                </div>
                <div class="submit-btn">
                    <button type="submit" class="btn">支払う</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection('content')
