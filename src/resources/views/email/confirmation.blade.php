<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>予約確認</title>
</head>
<body>
    <h1>予約日当日です。</h1>
    <p>{{ $user->name }}様、ご来店をお待ちしております。</p>
    <ul>
        <li>店舗名: {{ $reservation->shop->name }}</li>
        <li>予約日時: {{ $reservation->start_at }}</li>
    </ul>
</body>
</html>