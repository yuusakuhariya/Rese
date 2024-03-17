@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/login.css') }}" />
@endsection

@section('content')

<main>
    <div class="container">
        <div class="content_title">
            <div class="content_title_login">login</div>
        </div>
        <div class="form">
            <form class="form_login" action="/login" method="post">
                @csrf
                <div class="form_field">
                    <span><img src="/image/mail.svg"></span><input class="input_email" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                    <div class="form_error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form_field">
                    <span><img src="/image/key.svg"></span><input class="input_password" type="password" name="password" placeholder="Password">
                    <div class="form_error">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div align="right" class="form_field">
                    <button class="form_button" type="submit">ログイン</button>
                </div>
            </form>
        </div>


    </div>
</main>

@endsection