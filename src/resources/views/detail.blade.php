<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
</head>
<body class="body">
    <div class="grid-layout">
        <header class="header">
                <a href="/menu" class="to_menu">
                    <button class="hamburger">
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                    </button>
                </a>
                <h1 class="header-ttl">Rese</h1>
        </header>
        <main class="content">
            <div class="shop-detail">
                <div class="shop-detail__heading">
                    <div class="back">
                        <a href="/" class="back-btn">＜</a>
                    </div>
                    <h2 class="shop-name">{{ $shop->name }}</h2>
                </div>
                <div class="shop-img">
                    <img src="{{ $shop->image_url }}" alt="img" class="img">
                </div>
                <div class="shop-tag">
                    <p class="tag">#{{ $shop->area->name }}</p>
                    <p class="tag">#{{ $shop->genre->name}}</p>
                </div>
                <div class="shop-desc">
                    <p class="desc">{{ $shop->description }}</p>
                </div>
            </div>
            <div class="reservation">
                <div class="reservation-box">
                    <h3 class="reservation__heading">予約</h3>
                    <form action="{{ route('confirm') }}" method="post" class="reservation-form">
                        @csrf
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        <div class="form-group">
                            <input type="date" id="date" name="date" class="form-input" placeholder="予約日">
                            <p class="error-message">
                                @error('date')
                                {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="form-group">
                            <select name="time" class="select">
                                <option disabled selected class="time-select">時間</option>
                                <option>17:00</option>
                                <option>17:30</option>
                                <option>18:00</option>
                                <option>18:30</option>
                                <option>19:00</option>
                                <option>19:30</option>
                                <option>20:00</option>
                                <option>20:30</option>
                                <option>21:00</option>
                            </select>
                            <p class="error-message">
                                @error('time')
                                {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="form-group">
                            <select name="num_of_users" class="select">
                                <option disabled selected class="num-select">人数</option>
                                <option value="1">1名</option>
                                <option value="2">2名</option>
                                <option value="3">3名</option>
                                <option value="4">4名</option>
                                <option value="5">5名</option>
                                <option value="6">6名</option>
                                <option value="7">7名</option>
                                <option value="8">8名</option>
                            </select>
                            <p class="error-message">
                                @error('num_of_users')
                                {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="confirm">
                            <table class="confirm-table">
                                <tr class="confirm-table__row">
                                    <th class="confirm-form__label">Shop</th>
                                    <td class="confirm-form__data"></td>
                                </tr>
                                <tr class="confirm-table__row">
                                    <th class="confirm-form__label">Date</th>
                                    <td class="confirm-form__data"></td>
                                </tr>
                                <tr class="confirm-table__row">
                                    <th class="confirm-form__label">Time</th>
                                    <td class="confirm-form__data"></td>
                                </tr>
                                <tr class="confirm-table__row">
                                    <th class="confirm-form__label">Number</th>
                                    <td class="confirm-form__data"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="reservation-btn">
                            <input type="submit" class="btn" value="予約する">
                        </div>
                    </form>
                </div>
            </div>
            <div class="reviews">
                <h4 class="reviews__heading">レビュー</h4>
                @foreach($shop->reviews as $review)
                <div class="review-box">
                    <div class="review-group">
                        <label for="date" class="label">投稿日:</label>
                        <p class="date">{{ $review->created_at->format('Y-m-d') }}</p>
                    </div>
                    <div class="review-group">
                        <div class="rating">
                            @if($review->rating == 1)
                            ⭐️
                            @elseif($review->rating == 2)
                            ⭐️⭐️
                            @elseif($review->rating == 3)
                            ⭐️⭐️⭐️
                            @elseif($review->rating == 4)
                            ⭐️⭐️⭐️⭐️
                            @else
                            ⭐️⭐️⭐️⭐️⭐️
                            @endif
                        </div>
                    </div>
                    <div class="review-group">
                        <div class="comment">{{ $review->comment }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </main>
    </div>
</body>
</html>

