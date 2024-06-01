<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/thanks.css') }}" />
</head>

<body>

    <header class="header">
        <div class="header_inner">
                <button class="menu_button" type="submit">
                    <span class="hamburger_bar"></span>
                    <span class="hamburger_bar"></span>
                    <span class="hamburger_bar"></span>
                </button>
            <div class="header_title">Rese</div>
        </div>
    </header>

    <main>
        <div class="container">
            <div class="content">
                <div class="content_message">
                    会員登録ありがとうございます
                </div>
                <div class="content_message_login"><a class="login-button" href="{{ route('loginShopAll') }}">ログインする</a></div>
            </div>
        </div>
    </main>

</body>