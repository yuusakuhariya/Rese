<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/adminMenu.css') }}" />
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
        <div class="container">
            <div class="content">
                <div class="massage"><a href="/">店舗登録</a></div>
                <div class="massage"><a href="{{ route('adminMail') }}">メール送信</a></div>
                <div class="massage">
                    <form class="logout-form" action="/logout" method="post">
                        @csrf
                        <button class="logout-button">ログアウト</button>
                    </form>
                </div>
            </div>
        </div>
    </main>


</body>

</html>