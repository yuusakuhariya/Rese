<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />
    @yield('css')
</head>

<body>

    <header class="header">
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
    </header>

    @yield('content')

</body>

</html>