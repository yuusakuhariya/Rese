@extends('layouts.menuLayout')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/homeMenu.css') }}" />
@endsection

@section('content')

<main>
    <div class="container">
        <div class="content">
            <div class="massage"><a class="message_inner" href="{{ route('shopAll') }}">ホーム</a></div>
            <div class="massage"><a class="message_inner" href="{{ route('register') }}">新規登録</a></div>
            <div class="massage"><a class="message_inner" href="{{ route('login') }}">ログイン</a></div>
        </div>
    </div>
</main>

@endsection