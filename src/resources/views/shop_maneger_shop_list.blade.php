<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/shopManegerShopList.css') }}" />
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <div class="header_menu">
                <a href="{{ route('shopManegerMenu') }}">
                    <button class="menu_button" href="/">
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                    </button>
                </a>
            </div>
            <div class="header_title">Rese</div>
        </div>
    </header>

    <main>
        <div class="shop-user_container">
            @foreach ($shops as $shop)
            <div class="container-inner">
                <div class="card-img">
                    <img class="shop-img" src="{{ Storage::url($shop->img_path) }}" onerror="this.onerror=null; this.src='{{ $shop->img_path }}'" alt="サンプル画像">
                </div>
                <div class="shop-card">
                    <div class="shop_name">{{ $shop->shop_name }}</div>
                </div>
                <div class="shop-card">
                    <div class="tag-area">＃{{ $shop->Area->area_name }}</div>
                </div>
                <div class="shop-card">
                    <div class="tag-genre">＃{{ $shop->Genre->genre_name }}</div>
                </div>
                <div class="card-content_button">
                    <div class="detail-button">
                        <button class="detail">
                            <a class="detail-inner" href="{{ route('shopUpdate',['id' => $shop->id]) }}">更新</a>
                        </button>
                    </div>
                    <div class="detail-button">
                        <button class="detail">
                            <a class="detail-inner" href="{{ route('shopManegerReservationList', ['id' => $shop->id]) }}">予約一覧</a>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

</body>

</html>