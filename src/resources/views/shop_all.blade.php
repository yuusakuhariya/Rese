<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/shop_all.css') }}" />
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <div class="header_menu">
                @if(auth()->check())
                <a href="{{ route('menu_1') }}">
                    <button class="menu_button" href="/">
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                    </button>
                </a>
                @else
                <a href="{{ route('menu_2') }}">
                    <button class="menu_button" href="/">
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                    </button>
                </a>
                @endif
            </div>
            <div class="header_title">Rese</div>
        </div>
        <div class="search">
            <div class="select">
                <select name="select-all-area">
                    <option value="" selected>All area</option>
                    <option value="北海道">北海道</option>
                    <option value="青森県">青森県</option>
                    <option value="岩手県">岩手県</option>
                    <option value="宮城県">宮城県</option>
                    <option value="秋田県">秋田県</option>
                    <option value="山形県">山形県</option>
                    <option value="福島県">福島県</option>
                    <option value="茨城県">茨城県</option>
                    <option value="栃木県">栃木県</option>
                    <option value="群馬県">群馬県</option>
                    <option value="埼玉県">埼玉県</option>
                    <option value="千葉県">千葉県</option>
                    <option value="東京都">東京都</option>
                    <option value="神奈川県">神奈川県</option>
                    <option value="新潟県">新潟県</option>
                    <option value="富山県">富山県</option>
                    <option value="石川県">石川県</option>
                    <option value="福井県">福井県</option>
                    <option value="山梨県">山梨県</option>
                    <option value="長野県">長野県</option>
                    <option value="岐阜県">岐阜県</option>
                    <option value="静岡県">静岡県</option>
                    <option value="愛知県">愛知県</option>
                    <option value="三重県">三重県</option>
                    <option value="滋賀県">滋賀県</option>
                    <option value="京都府">京都府</option>
                    <option value="大阪府">大阪府</option>
                    <option value="兵庫県">兵庫県</option>
                    <option value="奈良県">奈良県</option>
                    <option value="和歌山県">和歌山県</option>
                    <option value="鳥取県">鳥取県</option>
                    <option value="島根県">島根県</option>
                    <option value="岡山県">岡山県</option>
                    <option value="広島県">広島県</option>
                    <option value="山口県">山口県</option>
                    <option value="徳島県">徳島県</option>
                    <option value="香川県">香川県</option>
                    <option value="愛媛県">愛媛県</option>
                    <option value="高知県">高知県</option>
                    <option value="福岡県">福岡県</option>
                    <option value="佐賀県">佐賀県</option>
                    <option value="長崎県">長崎県</option>
                    <option value="熊本県">熊本県</option>
                    <option value="大分県">大分県</option>
                    <option value="宮崎県">宮崎県</option>
                    <option value="鹿児島県">鹿児島県</option>
                    <option value="沖縄県">沖縄県</option>
                </select>
            </div>
            <div class="select">
                <select name="select-all-genre">
                    <option value="" selected>All genre</option>
                    <option value="寿司">寿司</option>
                    <option value="焼肉">焼肉</option>
                    <option value="居酒屋">居酒屋</option>
                    <option value="ラーメン">ラーメン</option>
                    <option value="イタリアン">イタリアン</option>
                </select>
            </div>
            <button class="search-button"></button>
            <input class="search-input" type="text" value="Search …">
        </div>
    </header>

    <main>
        <div class="all-shop_container">
            @foreach ($AllShopLists as $shop)
            <div class="favorite-card">
                <div class="card-img">
                    <img class="shop-img" src="{{ $shop->imag_path }}" alt="サンプル画像">
                </div>
                <div class="card-content">
                    <div class="card-content_shop-name">{{ $shop->shop_name }}</div>
                    <div class="card-content_tag">
                        <div class="tag-area">＃{{ $shop->Area->area_name }}</div>
                        <div class="tag-genre">＃{{ $shop->Genre->genre_name }}</div>
                    </div>
                    <div class="card-content_button">
                        <div class="detail-button">
                            <button class="detail">
                                <a class="detail-inner" href="{{ route('shop_detail', ['id' => $shop->id]) }}">詳しくみる</a>
                            </button>
                        </div>
                        @if($isAuthenticated)
                        @if(!in_array($shop->id, $favoriteShopIds))
                        <div class="favorite-button">
                            <form action="{{ route('addFavorites', ['id' => $shop->id, 'user_id' => auth()->user()->id, 'shop_id' => $shop->id]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="heart-icon">
                                <button type="submit" class="logo">
                                    <img class="favorite-icon" src="/image/heart-solid-gray.svg" alt="">
                                </button>
                            </form>
                        </div>
                        @else
                        <div class="favorite-button">
                            <form action="{{ route('removeFavorites', ['id' => $shop->id, 'user_id' => auth()->user()->id, 'shop_id' => $shop->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="heart-icon">
                                <button type="submit" class="logo">
                                    <img class="favorite-icon" src="/image/heart-solid-red.svg" alt="">
                                </button>
                            </form>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </main>

</body>

</html>