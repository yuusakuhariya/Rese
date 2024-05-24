<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}" />
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <div class="header_menu">
                <a href="{{ route('adminMenuUserListMail') }}">
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
        @if (session('success'))
        <div class="success-message">{{ session('success') }}</div>
        @endif
        <div class="shop-register_container">
            <h2 class="content-title">店舗代表者 登録</h2>
            <form class="shop-register_form" action="{{ route('userStore') }}" method="post">
                @csrf
                <div class="form-title">
                    <div class="form-title-inner">店舗代表者名</div>
                    <input class="form-input" type="name" name="name" placeholder="店舗代表者名" value="{{ old('name') }}">
                </div>
                <div class="form-error">
                    @error('name')
                    {{$errors->first('name')}}
                    @enderror
                </div>
                <div class="form-title">
                    <div class="form-title-inner">メールアドレス</div>
                    <input class="form-input" type="email" name="email" placeholder="email" value="{{ old('email') }}">
                </div>
                <div class="form-error">
                    @error('email')
                    {{$errors->first('email')}}
                    @enderror
                </div>
                <div class="form-title">
                    <div class="form-title-inner">パスワード</div>
                    <input class="form-input" type="password" name="password" placeholder="password">
                </div>
                <div class="form-error">
                    @error('password')
                    {{$errors->first('password')}}
                    @enderror
                </div>
                <input class="form-input" type="hidden" name="role" value="shop">
                <div class="button">
                    <button class="form_button" type="submit">登録</button>
                </div>
            </form>
        </div>
    </main>

</body>

</html>