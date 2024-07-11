<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/reviewList.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <div class="header_menu">
                <button class="close_button">
                    <a class="close_button_inner" href="{{ url()->previous() }}">
                        <span class="dli-close"></span>
                    </a>
                </button>
            </div>
        </div>
    </header>

    <main>
        <div class="review-container">
            <h1>レビュー</h1>
            <h2>店名 : {{ $shop->shop_name }}</h2>
            @foreach($reviews as $review)
            <div class="user-review">
                <div class="use-review_name">名前：{{ $review->user->name }}</div>
                <div>
                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$review->rating)
                        <span class="star">★</span>
                        @else
                        <span class="empty-star">★</span>
                        @endif
                        @endfor
                </div>
                <div class="review-comment_title">コメント</div>
                <div class="review-comment_content">{{ $review->comment }}</div>
            </div>
            @endforeach
        </div>
        <div class="pagination">{{ $reviews->links('vendor.pagination.bootstrap-4') }}</div>
    </main>


</body>

</html>