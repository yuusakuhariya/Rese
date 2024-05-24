@extends('layouts.menuLayout')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/loginMenu.css') }}" />
@endsection

@section('content')

<main>
    <div class="container">
        <div class="content">
            <div class="massage"><a href="{{ route('shopAll') }}">ホーム</a></div>
            <div class="massage">
                <form class="logout-form" action="/logout" method="post">
                    @csrf
                    <button class="logout-button">ログアウト</button>
                </form>
            </div>
            <div class="massage"><a href="{{ route('myPage', ['id' => auth()->user()->id]) }}">マイページ</a></div>
        </div>
    </div>
</main>

@endsection