@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/thanks.css') }}" />
@endsection

@section('content')

<main>
    <div class="container">
        <div class="content">
            <div class="content_message">
                会員登録ありがとうございます
            </div>
            <div class="content_message_login"><a class="login-button" href="{{ route('shop_all') }}">ログインする</a></div>
        </div>
    </div>
</main>

@endsection