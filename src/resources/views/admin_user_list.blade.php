<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/adminUserList.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <div class="header_menu">
                <a href="{{ route('adminMenuShopRegisterMail') }}">
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
                    <input class="search-name" type="text" name="keyword" value="" placeholder="名前">
                    <button class="search-button" type="submit">検索</button>
                </form>
                <div class="table">
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
                    <div class="pagination">{{ $userSearches->links('vendor.pagination.bootstrap-4') }}</div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>