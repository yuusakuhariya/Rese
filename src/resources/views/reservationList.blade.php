<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('/css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/reservationList.css') }}" />
</head>

<body>

    <header class="header">
        <div class="header_inner">
            <a class="back-button" href="/">back</a>
        </div>
    </header>

    <main>
        <table class="list-table">
            <tr>
                <th class="table-th_name">名前</th>
                <th class="table-th_email">メールアドレス</th>
                <th class="table-th_date">予約日</th>
                <th class="table-th_time">予約時間</th>
                <th class="table-th_number-of-person">人数</th>
            </tr>
            @foreach ($reservations as $reservation)
            <tr>
                <td class="table-td_name">{{ $reservation->user->name }}</td>
                <td class="table-td_email">{{ $reservation->user->email }}</td>
                <td class="table-td_date">{{ $reservation->date }}</td>
                <td class="table-td_time">{{ $reservation->time }}</td>
                <td class="table-td_number-of-person">{{ $reservation->number_of_person }}</td>
            </tr>
            @endforeach
        </table>

        <div class="email-container">
            <h2 class="email-title">メール送信機能</h2>
            <form class="email-form" action="{{ route('send.notification') }}" method="POST">
                @csrf
                <input type="hidden" name="email" value="{{ $user->email }}">
                <div class="form-subject">件名</div>
                <input class="input-subject" type="text" name="subject">
                <div class="form-email">メールアドレス</div>
                <select class="select-email" name="userEmail" multiple>
                    <option value="">選択してください</option>
                    @foreach ($reservations as $reservation)
                    <option value="{{ $reservation->user->email }}">{{ $reservation->user->email }}</option>
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