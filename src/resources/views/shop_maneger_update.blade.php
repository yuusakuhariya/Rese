<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/shopManegerUpdate.css') }}" />
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <div class="header_menu">
                <button class="close_button">
                    <a class="close_button_inner" href="/">
                        <span class="dli-close"></span>
                    </a>
                </button>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="shop-register_container">
                <h2 class="content-title">店舗 更新</h2>
                <form class="shop-register_form" action="{{ route('shopRenew', ['id' => $shop->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-title">
                        <div class="form-title_inner">店名</div>
                        <input class="form-input" type="name" name="shop_name" placeholder="店名">

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
                        <input class="form-input" type="text" name="area_name" placeholder="地域">
                    </div>
                    <div class="form-error">
                        @error('area_name')
                        {{$errors->first('area_name')}}
                        @enderror
                    </div>

                    <div class="form-title">
                        <div class="form-title_inner">ジャンル</div>
                        <input class="form-input" type="text" name="genre_name" placeholder="ジャンル">
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
                        <button class="form_button" type="submit">更新</button>
                    </div>
                </form>
            </div>
            <div class="shop-user_container">
                <h2 class="content-title">店舗 情報</h2>
                <div class="container-inner">
                    <div class="card-img">
                        <img class="shop-img" src="{{ Storage::url($shop->img_path) }}" onerror="this.onerror=null; this.src='{{ $shop->img_path }}'" alt="サンプル画像">
                    </div>
                    <div class="shop-card">
                        <div class="shop_name">{{ $shop->shop_name }}</div>
                    </div>
                    <div class="shop-card">
                        <div class="tag-area">＃{{ $shop->Area->area_name }}</div>
                    </div>
                    <div class="shop-card">
                        <div class="tag-genre">＃{{ $shop->Genre->genre_name }}</div>
                    </div>
                    <div class="shop-card">
                        <div class="card-detail">{{ $shop->content }}</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>