@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_edit.css')}}">
@endsection

@section('content')
<div class="container">
    <h2 class="heading__ttl">レビューの投稿</h2>
    <div class="review__edit">
        <div class="review__form">
            <form action="{{ route('reviews.store') }}" method="post">
                @csrf
                <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                <div class="form-group">
                    <label for="comment" class="label">点数：</label>
                    <select name="rating" id="rating" class="rating">
                        <option value="1">⭐️</option>
                        <option value="2">⭐️⭐️</option>
                        <option value="3">⭐️⭐️⭐️</option>
                        <option value="4">⭐️⭐️⭐️⭐️</option>
                        <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment" class="label">コメント：</label>
                    <textarea name="comment" id="comment" cols="30" rows="10" class="textarea"></textarea>
                </div>
                <div class="submit-btn">
                    <button type="submit" class="submit">投稿する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
