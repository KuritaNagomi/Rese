@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css')}}">
@endsection

@section('content')
    <div class="my_page">
        <div class="content-heading">
            <h2 class="name"><?php $user = Auth::user(); ?>{{ $user->name }}さん</h2>
        </div>
        <div class="content">
            <div class="content__left">
                <h3 class="content-heading">予約状況</h3>
                @foreach($reservations as $index => $reservation)
                <div class="reserved">
                    <table class="reserved-table">
                        <div class="reserved-table__heading">
                            <h5 class="reserved-table-num">予約{{ $index + 1}}</h5>
                            <form action="{{ route('delete', $reservation->id)}}" method="post" class="delete">
                                @csrf
                                @method('DELETE')
                                <button class="delete_btn" type="submit">
                                    <img class="img__delete" src="{{ asset('img/delete.png' )}}" alt="削除">
                                </button>
                            </form>
                        </div>
                        <tr class="reserved-table__row">
                            <th class="reserved-table__label">Shop</th>
                            <td class="reserved-table__data">{{ $reservation->shop->name }}</td>
                        </tr>
                        <tr class="reserved-table__row">
                            <th class="reserved-table__label">Date</th>
                            <td class="reserved-table__data">{{ \Carbon\Carbon::parse($reservation->start_at)->format('Y-m-d') }}</td>
                        </tr>
                        <tr class="reserved-table__row">
                            <th class="reserved-table__label">Time</th>
                            <td class="reserved-table__data">{{ \Carbon\Carbon::parse($reservation->start_at)->format('H:i') }}</td>
                        </tr>
                        <tr class="reserved-table__row">
                            <th class="reserved-table__label">Number</th>
                            <td class="reserved-table__data">{{ $reservation->num_of_users }}人</td>
                        </tr>
                    </table>
                </div>
                @endforeach
            </div>
            <div class="content__right">
                <h4 class="content-heading">お気に入り店舗</h4>
                <div class="favorite-list">
                    @foreach($favoriteShops as $shop)
                    <div class="shop-card">
                        <div class="shop-img">
                            <img src="{{ $shop->image_url }}" alt="img" class="img">
                        </div>
                        <div class="card__content">
                            <h5 class="shop-name">{{ $shop->name }}
                            </h5>
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
                                            <img src="img/heart-red.png" alt="heart" class="favorite__img">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection