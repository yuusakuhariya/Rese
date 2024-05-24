<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/review.css') }}" />
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
    </header>

    <main>
        <div class="user_name">
            <h2 class="name">
                {{ auth()->user()->name }}さん
            </h2>
            <h3 class="review">
                レビューしてね！
            </h3>
        </div>
        <div class="review-container">
            <form class="review-form" action="{{ route('reviewStore') }}" method="post">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $reservationId->shop_id }}">
                <div class="rate-form">
                    <input id="star5" type="radio" name="rating" value="5">
                    <label for="star5">★</label>
                    <input id="star4" type="radio" name="rating" value="4">
                    <label for="star4">★</label>
                    <input id="star3" type="radio" name="rating" value="3">
                    <label for="star3">★</label>
                    <input id="star2" type="radio" name="rating" value="2">
                    <label for="star2">★</label>
                    <input id="star1" type="radio" name="rating" value="1">
                    <label for="star1">★</label>
                </div>
                <div class="comment">
                    <textarea class="comment-inner" name="comment" cols="30" rows="8" placeholder="コメント"></textarea>
                </div>
                <div class="button">
                    <button class="form-button" type="submit">投稿</button>
                </div>
            </form>
        </div>
    </main>

</body>

</html>