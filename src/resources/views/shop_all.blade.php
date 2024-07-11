<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    @if(auth()->check())
    <link rel="stylesheet" href="{{ asset('/css/shopAllLogin.css') }}" />
    @else
    <link rel="stylesheet" href="{{ asset('/css/shopAllHome.css') }}" />
    @endif
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <div class="header_menu">
                @if(auth()->check())
                <a href="{{ route('loginMenu') }}">
                    <button class="menu_button" href="/">
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                        <span class="hamburger_bar"></span>
                    </button>
                </a>
                @else
                <a href="{{ route('homeMenu') }}">
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
        <form class="search" action="{{ route('search')}} " method="get">
            @csrf
            <div class="select">
                <select class="select_name" name="area_id">
                    <option value="" selected>地域</option>
                    @foreach ($allAreas as $area)
                    <option value="{{ $area->id }}">{{ $area->area_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="select">
                <select class="select_name" name="genre_id">
                    <option value="" selected>ジャンル</option>
                    @foreach ($allGenres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->genre_name}}</option>
                    @endforeach
                </select>
            </div>
            <button class="search-button" type="submit"></button>
            <input class="search-input" type="text" name="keyword" value="" placeholder="文字入力 …">
        </form>
    </header>

    <div class="sort">
        <div class="sort_title">並び替え</div>
        <form class="select_form" action="{{ route('shops') }}" method="get">
            @csrf
            <select name="sort" class="sort_select" onchange="this.form.submit()">
                <option value="">選択してください</option>
                <option value="area">地域</option>
                <option value="genre">ジャンル</option>
                <option value="high_to_low">評価高</option>
                <option value="low_to_high">評価低</option>
                <!-- <option value="shop_name_asc">あいうえお</option> -->
            </select>
        </form>
    </div>


    <main>
        <div class="all-shop_container">
            @if(isset($searchShops))
            @foreach ($searchShops as $shop)
            <div class="favorite-card">
                <div class="card-img">
                    <img class="shop-img" src="{{ Storage::url($shop->img_path) }}" onerror="this.onerror=null; this.src='{{ $shop->img_path }}'" alt="サンプル画像">
                </div>
                <div class="card-content">
                    <div class="card-content_title">
                        <div class="card-content_shop-name">{{ $shop->shop_name }}</div>
                        <div class="review-content">
                            <div class="review-frame">
                                <div class="review-like_icon">★</div>

                                <div class="review-average">{{ $shop->Review->rating }}</div>

                            </div>
                            <div class="review-frame">
                                <div class="review-comment_icon"><a class="icon_button" href="{{route('review_list', ['id' => $shop->id]) }}"></a></div>
                                <div class="review-comment_number">{{ $shop->Review->comment }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content_tag">
                        <div class="tag-area">＃{{ $shop->Area->area_name }}</div>
                        <div class="tag-genre">＃{{ $shop->Genre->genre_name }}</div>
                    </div>
                    <div class="card-content_button">
                        <div class="detail-button">
                            <button class="detail">
                                <a class="detail-inner" href="{{ route('shopDetail', ['id' => $shop->id]) }}">詳しくみる</a>
                            </button>
                        </div>
                        @if($user)
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
            @else
            @foreach ($allShopLists as $shop)
            <div class="favorite-card">
                <div class="card-img">
                    <img class="shop-img" src="{{ Storage::url($shop->img_path) }}" onerror="this.onerror=null; this.src='{{ $shop->img_path }}'" alt="サンプル画像">
                </div>
                <div class="card-content">
                    <div class="card-content_title">
                        <div class="card-content_shop-name">{{ $shop->shop_name }}</div>
                        <div class="review-content">
                            <div class="review-frame">
                                <div class="review-like_icon">★</div>

                                <div class="review-average">{{ $shop->average_rating }}</div>

                            </div>
                            <div class="review-frame">
                                <div class="review-comment_icon"><a class="icon_button" href="{{route('review_list', ['id' => $shop->id]) }}"></a></div>
                                <div class="review-comment_number">{{ $shop->comment_count }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content_tag">
                        <div class="tag-area">＃{{ $shop->Area->area_name }}</div>
                        <div class="tag-genre">＃{{ $shop->Genre->genre_name }}</div>
                    </div>
                    <div class="card-content_button">
                        <div class="detail-button">
                            <button class="detail">
                                <a class="detail-inner" href="{{ route('shopDetail', ['id' => $shop->id]) }}">詳しくみる</a>
                            </button>
                        </div>
                        @if($user)
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
            @endif
        </div>
    </main>

</body>

</html>