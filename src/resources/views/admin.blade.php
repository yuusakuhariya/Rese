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
            <form class="logout-form" action="/logout" method="post">
                @csrf
                <button class="logout-button">logout</button>
            </form>
        </div>
    </header>

    <main>
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

        <div>
            <h3>Send Notification</h3>
            <form action="{{ route('send.notification') }}" method="POST">
                @csrf
                <button type="submit">Send Notification Email</button>
            </form>
        </div>

        <div class="user-list">
            <h2 class="content-title">ユーザー一覧</h2>
            <div class="search">
                <form class="search-form" action="{{ route('userSearch') }}" method="get">
                    @csrf
                    <select class="role-select" name="role">
                        <option value="" selected>権限</option>
                        <option value="user">ユーザー</option>
                        <option value="shop">店舗代表者</option>
                        <option value="admin">管理者</option>
                    </select>
                    <input class="search-name" type="text" name="keyword" value="" placeholder="name">
                    <button class="search-button" type="submit">検索</button>
                </form>

                <table class="list-table">
                    <tr>
                        <th class="table-th_role">権限</th>
                        <th class="table-th_name">名前</th>
                        <th class="table-th_email">メールアドレス</th>
                        <th class="table-th_delete">削除</th>
                    </tr>
                    @foreach ($userSearches as $user)
                    <tr>
                        <td class="table-td_role">{{ $user->role }}</td>
                        <td class="table-td_name">{{ $user->name }}</td>
                        <td class="table-td_email">{{ $user->email }}</td>
                        <td class="table-delete">
                            <form class="delete-form" action="{{ route('userDelete', ['id' => $user->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="delete-button" type="submit">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </main>

</body>

</html>