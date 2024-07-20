@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('search')
<div class="search">
    <div class="search-bar">
        <form action="/search" method="get" class="search-form">
            @csrf
            <div class="search-form__select">
                <select name="area" class="select" value="{{ request('area_id')}}">
                    <option disabled selected>All area</option>
                    @foreach($areas as $area)
                    <option value="{{ $area->id }}" @if(request('area')==$area->id) selected @endif>{{ $area->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-form__select">
                <select name="genre"  class="select">
                    <option disabled selected>All genre</option>
                    @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" @if(request('genre')==$genre->id) selected @endif>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-box">
                <input type="text" name="keyword" class="search-keyword"  placeholder="Search..." value="{{ request('keyword') }}">
            </div>
            <input class="search-btn" type="submit" value="検索">
        </form>
    </div>
</div>
@endsection

@section('content')
<div class="shop_all">
    @foreach($shops as $shop)
    <div class="shop-card">
        <div class="shop-img">
            <img src="{{ $shop->image_url }}" alt="img" class="img">
        </div>
        <div class="card__content">
            <h2 class="shop-name">{{ $shop->name }}
            </h2>
            <div class="card__tag">
                <p class="tag">#{{ $shop->area->name }}</p>
                <p class="tag">#{{ $shop->genre->name }}
                </p>
            </div>
            <div class="shop__actions">
                <div class="shop__detail">
                    <a href="{{ route('shop.detail', ['id' => $shop->id]) }}" class="detail">詳しくみる</a>
                </div>
                <div class="favorite">
                    <form action="/favorite/toggle" method="post">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <button class="favorite-btn">
                            @if(isset($favoriteShops) && in_array($shop->id, $favoriteShops))
                                <img src="img/heart-red.png" alt="heart" class="favorite__img">
                            @else
                                <img src="img/heart.png" alt="heart" class="favorite__img">
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
