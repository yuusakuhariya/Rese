<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/my_page.css') }}" />
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
    </header>

    <main>
        <div class="user_name">
            <h2 class="name">
                {{ auth()->user()->name }}さん
            </h2>
        </div>
        <div class="container">
            <div class="reservation-status_content">
                <div class="reservation-status_title">予約状況</div>

                @foreach($reservations as $reservation)
                <div class="reservation-status_inner">
                    <div class="inner-title">
                        <div class="inner-title_label">
                            <div class="reservation-status_logo"><img src="/image/clock.svg"></div>
                            <div class="reservation-status_select">予約</div>
                        </div>
                        <form action="{{ route('delete', ['id' => $reservation->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="inner-delete"><span></span></button>
                        </form>
                    </div>
                    <div class="inner-item">
                        <table class="inner-table">
                            <tr>
                                <td class="item-name">Shop</td>
                                <td class="item-name">{{ $reservation->shop->shop_name }}</td>
                            </tr>
                            <tr>
                                <td class="item-date">Date</td>
                                <td class="item-date">{{ $reservation->date }}</td>
                            </tr>
                            <tr>
                                <td class="item-time">time</td>
                                <td class="item-time">{{ $reservation->time }}</td>
                            </tr>
                            <tr>
                                <td class="item-number">Number</td>
                                <td class="item-number">{{ $reservation->number_of_person }}人</td>
                            </tr>
                        </table>
                    </div>
                    <div class="reservation-change">
                        <button class="reservation-change_button" type="submit">変更</button>
                    </div>
                </div>
                @endforeach
                <div>
                    {{ $reservations->links() }}
                </div>
            </div>

            <div class="favorite_content">
                <div class="favorite_title">
                    <div class="favorite_title-name">
                        お気に入り店舗
                    </div>
                    <div class="favorite_inner-card">
                        @foreach($favorites as $favorite)
                        <div class="favorite-card">
                            <div class="card-img">
                                <img class="shop-img" src="{{ $favorite->shop->imag_path }}" alt="">
                            </div>
                            <div class="card-content">
                                <div class="card-content_shop-name">{{ $favorite->shop->shop_name }}</div>
                                <div class="card-content_tag">
                                    <div class="tag-area">＃{{ $favorite->shop->area->area_name }}</div>
                                    <div class="tag-genre">＃{{ $favorite->shop->genre->genre_name }}</div>
                                </div>
                                <div class="card-content_button">
                                    <div class="detail-button">
                                        <button class="detail">詳しくみる</button>
                                    </div>
                                    <div class="favorite-button">
                                        <button class="logo">
                                            <img class="favorite-icon" src="/image/heart-solid-red.svg" alt="">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div>
                        {{ $favorites->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>