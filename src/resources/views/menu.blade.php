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
        <form action="/logout" method="post"  class="logout-form">
        @csrf
            <button class="logout-btn">Logout</button>
        </form>
    </li>
    <li class="nav-item">
        <a href="/my_page" class="link">Mypage</a>
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