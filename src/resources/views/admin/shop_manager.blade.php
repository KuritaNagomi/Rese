@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop_manager.css')}}">
@endsection

@section('content')
    <div class="my_page">
        <div class="content-heading">
            <h2 class="name"><?php $user = Auth::user(); ?>{{ $user->name }}さん</h2>
            @if (session('message'))
            <div class="alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
        <div class="content">
            <div class="content__left">
                <h3 class="content-heading">予約状況</h3>
                @foreach($reservations as $reservation)
                <div class="reserved">
                    <div class="reserved-table__heading">
                        <h5 class="reserved-table-num">予約</h5>
                    </div>
                    <table class="reserved-table">
                        <tr class="reserved-table__row">
                            <th class="reserved-table__label">Shop</th>
                            <td class="reserved-table__data">{{ $reservation->shop->name }}</td>
                        </tr>
                        <tr class="reserved-table__row">
                            <th class="reserved-table__label">Name</th>
                            <td class="reserved-table__data">{{ $reservation->user->name }}</td>
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
                    <div class="email">
                        <a href="{{ route('email_form', ['userId' => $reservation->user->id]) }}" class="email-btn">メールを送信</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="content__right">
                <h4 class="content-heading">店舗情報の作成</h4>
                <form action="{{ route('shops.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="label">店舗名</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="alert-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="genre" class="label">ジャンル</label>
                        <select name="genre_id" id="genre_id" class="form-control">
                            @foreach($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                        @error('genre')
                            <div class="alert-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="area" class="label">エリア</label>
                        <select name="area_id" id="area_id" class="form-control">
                            @foreach($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                        @error('area')
                            <div class="alert-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description" class="label">店舗紹介</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
                        @error('description')
                            <div class="alert-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" class="label">店舗写真</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                            <div class="alert-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn">登録</button>
                </form>
                <h5 class="shop-edit_heading">店舗情報の編集</h5>
                @if($shop)
                <div class="shop-edit">
                    <form action="{{ route('shop.update', ['id' => $shop->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                        <label for="name" class="label">店舗名</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $shop->name }}" >
                        @error('name')
                            <div class="alert-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="genre" class="label">ジャンル</label>
                        <select name="genre_id" id="genre_id" class="form-control">
                            @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $genre->id == $shop->genre_id ? 'selected' : '' }}>{{ $genre->name }}</option>
                            @endforeach
                        </select>
                        @error('genre')
                            <div class="alert-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="area" class="label">エリア</label>
                        <select name="area_id" id="area_id" class="form-control">
                            @foreach($areas as $area)
                            <option value="{{ $area->id }}" {{ $area->id == $shop->area_id ? 'selected' : '' }}>{{ $area->name }}</option>
                            @endforeach
                        </select>
                        @error('area')
                            <div class="alert-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description" class="label">店舗紹介</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $shop->description }}</textarea>
                        @error('description')
                            <div class="alert-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" class="label">店舗写真</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <input type="hidden" name="current_image" value="{{ $shop->image_url }}">
                        @error('image')
                            <div class="alert-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn">更新</button>
                    </form>
                </div>
                @else
                    <p>店舗情報がありません</p>
                @endif
            </div>
        </div>
    </div>
@endsection