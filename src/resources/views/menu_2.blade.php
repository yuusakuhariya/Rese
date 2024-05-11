@extends('layouts.menu')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/menu_2.css') }}" />
@endsection

@section('content')

<main>
    <div class="container">
        <div class="content">
            <div class="massage"><a class="message_inner" href="{{ route('shop_all') }}">ホーム</a></div>
            <div class="massage"><a class="message_inner" href="{{ route('register') }}">新規登録</a></div>
            <div class="massage"><a class="message_inner" href="{{ route('login') }}">ログイン</a></div>
        </div>
    </div>
</main>

@endsection