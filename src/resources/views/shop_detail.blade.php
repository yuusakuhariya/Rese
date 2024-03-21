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
                </div>
                <div class="title">
                    <div class="back-button">
                        <div class="back-button_inner"><a class="inner" href="{{ route('shop_all') }}">＜</a></div>
                    </div>
                    <div class="shop-name">{{ $shop->shop_name }}</div>
                </div>
                <div class="card-img">
                    <img class="shop-img" src="{{ $shop->imag_path }}" alt="サンプル画像">
                </div>
                <div class="card-content_tag">
                    <div class="tag-area">＃{{ $shop->Area->area_name }}</div>
                    <div class="tag-genre">＃{{ $shop->Genre->genre_name }}</div>
                </div>
                <div class="card-detail">
                    {{ $shop->content }}
                </div>
            </div>

            <div class="container-reservation">
                <form class="reservation-form" action="{{ route('store') }}" method="post">
                    @csrf
                    <div class="content_reservation">
                        <div class="reservation-title">予約</div>
                        <div class="date">
                            <input class="input_date" type="date" name="date" list="daylist" min="" onChange="document.getElementsByName('date_display')[0].value = this.value">
                        </div>
                        <div class="error">
                            @error('date')
                            {{$errors->first('date')}}
                            @enderror
                        </div>
                        <div class="select">
                            <select name="time" onChange="this.form.time_display.value=this.options[selectedIndex].text">
                                <option value="">選択してください</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                                <option value="22:00">22:00</option>
                            </select>
                        </div>
                        <div class="error">
                            @error('time')
                            {{$errors->first('time')}}
                            @enderror
                        </div>
                        <div class="select">
                            <select name="number_of_person" onChange="this.form.person.value=this.options[selectedIndex].text">
                                <option value="">選択してください</option>
                                <option value="1">1人</option>
                                <option value="2">2人</option>
                                <option value="3">3人</option>
                                <option value="4">4人</option>
                                <option value="5">5人</option>
                                <option value="6">6人</option>
                                <option value="7">7人</option>
                                <option value="8">8人</option>
                                <option value="9">9人</option>
                                <option value="10">10人</option>
                            </select>
                        </div>
                        <div class="error">
                            @error('number_of_person')
                            {{$errors->first('number_of_person')}}
                            @enderror
                        </div>
                        <div class="inner-item">
                            <table class="inner-table">
                                <tr>
                                    <td class="item-name">Shop</td>
                                    <td class="item-name"><input type="hidden" name="shop_id" value="{{ $shop->id }}">{{ $shop->shop_name }}</td>
                                </tr>
                                <tr>
                                    <td class="item-date">Date</td>
                                    <td class="item-date"><input class="item-date_inner" name="date_display" readonly></td>
                                </tr>
                                <tr>
                                    <td class="item-time">time</td>
                                    <td class="item-time"><input class="item-date_inner" name="time_display" readonly></td>
                                </tr>
                                <tr>
                                    <td class="item-number">Number</td>
                                    <td class="item-number"><input class="item-date_inner" name="person" readonly></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="reservation-button">
                        <button class="button" type="submit">
                            予約する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>

</html>