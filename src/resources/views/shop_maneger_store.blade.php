<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/shopManegerStore.css') }}" />
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <div class="header_menu">
                <a href="{{ route('shopManegerMenu') }}">
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
        <div class="container">
            <div class="shop-register_container">
                @if (session('success'))
                <div class="success-message">{{ session('success') }}</div>
                @endif
                <h2 class="content-title">店舗 登録</h2>
                <form class="shop-register_form" action="{{ route('shopCreate') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-title">
                        <div class="form-title_inner">店名</div>
                        <input class="form-input" type="name" name="shop_name" placeholder="店名" value="{{ old('shop_name') }}">
                    </div>
                    <div class="form-error">
                        @error('shop_name')
                        {{$errors->first('shop_name')}}
                        @enderror
                    </div>

                    <div class="form-title">
                        <div class="form-title_inner">画像</div>
                        <input class="form-input" type="file" name="img_path" accept=".png, .jpg, .jpeg, .pdf, .doc">
                    </div>
                    <div class="form-error">
                        @error('img_path')
                        {{$errors->first('img_path')}}
                        @enderror
                    </div>

                    <div class="form-title">
                        <div class="form-title_inner">地域</div>
                        <input class="form-input" type="text" name="area_name" placeholder="地域" value="{{ old('area_name') }}">
                    </div>
                    <div class="form-error">
                        @error('area_name')
                        {{$errors->first('area_name')}}
                        @enderror
                    </div>

                    <div class="form-title">
                        <div class="form-title_inner">ジャンル</div>
                        <input class="form-input" type="text" name="genre_name" placeholder="ジャンル" value="{{ old('area_genre') }}">
                    </div>
                    <div class="form-error">
                        @error('genre_name')
                        {{$errors->first('genre_name')}}
                        @enderror
                    </div>

                    <div class="form-title">
                        <div class="form-title_inner">詳細</div>
                        <textarea class="form-input" name="content" cols="30" rows="14"></textarea>
                    </div>
                    <div class="form-error">
                        @error('content')
                        {{$errors->first('content')}}
                        @enderror
                    </div>

                    <div class="button">
                        <button class="form_button" type="submit">作成</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

</body>

</html>