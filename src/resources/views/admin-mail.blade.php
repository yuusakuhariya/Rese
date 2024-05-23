<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/admin-mail.css') }}" />
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <div class="header_menu">
                <a href="{{ route('adminMenu_3') }}">
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
        <div class="email-container">
            <h2 class="email-title">メール送信機能</h2>
            <form class="email-form" action="{{ route('send.notification') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ $user->email }}">
                <div class="form-subject">件名</div>
                <input class="input-subject" type="text" name="subject">
                <div class="form-email">メールアドレス</div>
                <select class="select-email" name="userEmail[]" multiple>
                    <option value="">選択してください（複数選択可）</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->email }}">{{ $user->email }}</option>
                    @endforeach
                </select>
                <div class="form-content">内容</div>
                <textarea class="form-text" name="content" cols="50" rows="14"></textarea>
                <div class="form-button">
                    <button class="form-button_inner" type="submit">メール送信</button>
                </div>
            </form>
        </div>
    </main>

</body>

</html>