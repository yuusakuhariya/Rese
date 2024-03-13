@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/my_page.css') }}" />
@endsection

@section('content')

<main>
    <div class="user_name">
        <h2 class="name">
            testさん
        </h2>
    </div>
    <div class="container">
        <div class="reservation-status_content">
            <div class="reservation-status_title">予約状況</div>
            <div class="reservation-status_inner">
                <div class="inner-title">
                    <div class="inner-title_label">
                        <div class="reservation-status_logo"><img src="/image/clock.svg"></div>
                        <div class="reservation-status_select">予約１</div>
                    </div>
                    <button class="inner-delete"><span></span></button>
                </div>
                <div class="inner-item">
                    <table class="inner-table">
                        <tr>
                            <td class="item-name">Shop</td>
                            <td class="item-name">店名</td>
                        </tr>
                        <tr>
                            <td class="item-date">Date</td>
                            <td class="item-date">日付</td>
                        </tr>
                        <tr>
                            <td class="item-time">time</td>
                            <td class="item-time">時間</td>
                        </tr>
                        <tr>
                            <td class="item-number">Number</td>
                            <td class="item-number">１人</td>
                        </tr>
                    </table>
                </div>
                <div>
                変更
                </div>
            </div>
            
        </div>

        <div class="favorite_content">
            <div class="favorite_title">
                <div class="favorite_title-name">
                    お気に入り店舗
                </div>
                <div class="favorite_inner-card">
                    <div class="favorite-card">
                        <div class="card-img">
                            <img class="shop-img" src="" alt="">
                        </div>
                        <div class="card-content">
                            <div class="card-content_shop-name">店名</div>
                            <div class="card-content_tag">
                                <div class="tag-area">＃地名</div>
                                <div class="tag-genre">＃ジャンル名</div>
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
                    <div class="favorite-card">
                        <div class="card-img">
                            <img class="shop-img" src="" alt="">
                        </div>
                        <div class="card-content">
                            <div class="card-content_shop-name">店名</div>
                            <div class="card-content_tag">
                                <div class="tag-area">＃地名</div>
                                <div class="tag-genre">＃ジャンル名</div>
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
                </div>
            </div>
        </div>
    </div>
</main>

</body>

</html>

@endsection