<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRコード</title>
</head>
<body>
    <p>来店時に店舗スタッフへご提示ください。</p>
    <br>
    {!! $qrCode !!}
    <br>
    <a href="{{ route('my_page') }}">戻る</a>
</body>
</html>