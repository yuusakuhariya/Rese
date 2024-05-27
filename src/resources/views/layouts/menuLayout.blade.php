<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    @if(auth()->check())
    <link rel="stylesheet" href="{{ asset('/css/loginMenuLayout.css') }}" />
    @yield('css')
    @else
    <link rel="stylesheet" href="{{ asset('/css/homeMenuLayout.css') }}" />
    @yield('css')
    @endif
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
    @yield('content')

</body>

</html>