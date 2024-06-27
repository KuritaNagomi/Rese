@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/menu.css')}}">
@endsection

@section('content')
<ul class="nav-list">
    <li class="nav-item">
        <a href="/" class="link">Home</a>
    </li>
    @if (Auth::check())
    <li class="nav-item">
        <a href="{{ route('my_page') }}" class="link">Mypage</a>
    </li>
    @if (Auth::user()->role == 'admin')
    <li class="nav-item">
        <a href="/admin" class="link">Admin</a>
    </li>
    @endif
    @if (Auth::user()->role == 'shop_manager')
    <li class="nav-item">
        <a href="/shop_manager" class="link">Shop Manager</a>
    </li>
    @endif
    <li class="nav-item">
        <form action="/logout" method="post"  class="logout-form">
        @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </li>
    @else
    <li class="nav-item">
        <a href="/register" class="link">Registration</a>
    </li>
    <li class="nav-item">
        <a href="/login" class="link">Login</a>
    </li>
    @endif
</ul>
@endsection