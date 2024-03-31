<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/shopManeger.css') }}" />
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <form class="logout-form" action="/logout" method="post">
                @csrf
                <button class="logout-button">logout</button>
            </form>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="shop-register_container">
                <h2 class="content-title">店舗 登録</h2>
                <form class="shop-register_form" action="{{ route('shopStore') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-title">
                        <div class="form-title_inner">店名</div>
                        <input class="form-input" type="name" name="shop_name" placeholder="店名" value="{{ old('shop_name') }}">
                    </div>
                    <div class="form-error"></div>

                    <div class="form-title">
                        <div class="form-title_inner">画像</div>
                        <input class="form-input" type="file" name="imag_path" accept=".png, .jpg, .jpeg, .pdf, .doc">
                    </div>
                    <div class="form-error"></div>

                    <div class="form-title">
                        <div class="form-title_inner">地域</div>
                        <input class="form-input" type="text" name="area_name" placeholder="地域" value="{{ old('area_name') }}">
                    </div>
                    <div class="form-error"></div>

                    <div class="form-title">
                        <div class="form-title_inner">ジャンル</div>
                        <input class="form-input" type="text" name="genre_name" placeholder="ジャンル" value="{{ old('area_genre') }}">
                    </div>
                    <div class="form-error"></div>

                    <div class="form-title">
                        <div class="form-title_inner">詳細</div>
                        <textarea class="form-input" name="content" cols="30" rows="14"></textarea>
                    </div>

                    <div class="button">
                        <button class="form_button" type="submit">作成</button>
                    </div>
                    <!-- ここに店舗代表者が作成したデータがあれば更新のボタンに切り替わるようにする
                    <div class="button">
                        <button class="form_button" type="submit">更新</button>
                    </div> -->
                </form>
            </div>
            <div class="shop-user_container">
                <h2 class="content-title">店舗 情報</h2>
                <div class="container-inner">
                    <div class="card-img">
                        <img class="shop-img" src="" alt="サンプル画像">
                    </div>
                    <div class="shop-card">
                        <div class="shop_name">店名</div>
                    </div>
                    <div class="shop-card">
                        <div class="tag-area">＃地域</div>
                    </div>
                    <div class="shop-card">
                        <div class="tag-genre">＃ジャンル</div>
                    </div>
                    <div class="shop-card">
                        <div class="card-detail">詳細</div>
                    </div>
                </div>
            </div>
        </div>
    </main>