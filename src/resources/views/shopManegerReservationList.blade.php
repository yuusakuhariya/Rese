<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/shopManegerReservationList.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="table">
            <table class="list-table">
                <tr>
                    <th class="table-th_name">名前</th>
                    <th class="table-th_email">メールアドレス</th>
                    <th class="table-th_date">予約日</th>
                    <th class="table-th_time">予約時間</th>
                    <th class="table-th_number-of-person">人数</th>
                    <th class="table-th_number-of-person">来店</th>
                </tr>
                @foreach ($reservations as $reservation)
                <tr>
                    <td class="table-td_name">{{ $reservation->user->name }}</td>
                    <td class="table-td_email">{{ $reservation->user->email }}</td>
                    <td class="table-td_date">{{ $reservation->date }}</td>
                    <td class="table-td_time">{{ $reservation->time }}</td>
                    <td class="table-td_number-of-person">{{ $reservation->number_of_person }}</td>
                    <td class="table-td_number-of-person">{{ $reservation->is_visited ? '済' : '未' }}</td>
                </tr>
                @endforeach
            </table>
            <div class="pagination">{{ $reservations->links('vendor.pagination.bootstrap-4') }}</div>
        </div>
    </main>

</body>

</html>