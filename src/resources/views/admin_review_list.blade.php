<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/adminReviewList.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <div class="header_menu">
                <a href="{{ route('adminMenuReviewList') }}">
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
        <div class="table">
            <table class="list-table">
                <tr>
                    <th class="table-th_shop-name">店名</th>
                    <th class="table-th_user-name">ユーザー名</th>
                    <th class="table-th_rating">評価</th>
                    <th class="table-th_comment">コメント</th>
                    <th class="table-th_delete">削除</th>
                </tr>
                @foreach ($reviews as $review)
                <tr>
                    <td class="table-td_shop-name">{{ $review->shop->shop_name }}</td>
                    <td class="table-td_user-name">{{ $review->user->name }}</td>
                    <td class="table-td_rating">
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++) @if ($i <=$review->rating)
                                <span class="star">★</span>
                                @else
                                <span class="empty-star">★</span>
                                @endif
                                @endfor
                        </div>
                    </td>
                    <td class="table-td_comment">
                        <div class="comment-inner">{{ $review->comment }}</div>
                    </td>
                    <td class="table-td_delete">
                        <form class="delete-form" action="{{ route('adminReviewDelete', ['id' => $review->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="delete-button" type="submit">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <div class="pagination">{{ $reviews->links('vendor.pagination.bootstrap-4') }}</div>
        </div>
    </main>

</body>

</html>