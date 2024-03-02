<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/shop_detail.css') }}" />
</head>

<body>
    <main>
        <div class="container-all">
            <div class="container-various">
                <div class="header">
                    <div class="header_inner">
                        <div class="header_menu">
                            <button class="menu_button" href="/">
                                <span class="hamburger_bar"></span>
                                <span class="hamburger_bar"></span>
                                <span class="hamburger_bar"></span>
                            </button>
                        </div>
                        <div class="header_title">Rese</div>
                    </div>
                </div>
                <div class="title">
                    <div class="back-button">
                        <button class="left">＜</button>
                    </div>
                    <div class="shop-name">店名</div>
                </div>
                <div class="card-img">
                    <img class="shop-img" src="" alt="">
                </div>
                <div class="card-content_tag">
                    <div class="tag-area">＃地名</div>
                    <div class="tag-genre">＃ジャンル名</div>
                </div>
                <div class="card-detail">
                    ここに詳細が表示される
                </div>
            </div>

            <div class="container-reservation">
                <div class="content_reservation">
                    <div class="reservation-title">予約</div>
                    <div class="date">
                        <input class="input_date" type="date" name="day" list="daylist" min="">
                    </div>
                    <form action="">
                        <div class="select">
                            <select name="select-time">
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                            </select>
                        </div>
                        <div class="select">
                            <select name="select-number">
                                <option value="1人">1人</option>
                                <option value="2人">2人</option>
                                <option value="3人">3人</option>
                                <option value="4人">4人</option>
                            </select>
                        </div>
                    </form>
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
                </div>
                <div class="reservation-button">
                    <button class="button">
                        予約する
                    </button>
                </div>
            </div>
        </div>
    </main>

</body>

</html>