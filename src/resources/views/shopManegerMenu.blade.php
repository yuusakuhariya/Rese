<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/shopManegerMenu.css') }}" />
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
            <div class="content">
                <div class="massage">
                    <form class="logout-form" action="/logout" method="post">
                        @csrf
                        <button class="logout-button">ログアウト</button>
                    </form>
                </div>
                <div class="massage"><a href="{{ route('reservationList', ['id' => auth()->user()->id]) }}">予約一覧</a></div>
            </div>
        </div>
    </main>


</body>

</html>