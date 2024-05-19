@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/register.css') }}" />
@endsection

@section('content')

<main>
    <div class="container">
        <div class="content_title">
            <div class="content_title_registration">Registration</div>
        </div>
        <div class="form">
            <form class="form_register" action="/register" method="post">
                @csrf
                <div class="form_field">
                    <span><img src="/image/man.svg"></span><input class="input_name" type="text" name="name" placeholder="Username" value="{{ old('name') }}">
                    <div class="form_error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
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
                <div class="role">
                    <label class="role-type" for="role">登録タイプ</label>
                    <select name="role">
                        <option value="">選択してください</option>
                        <option value="user">ユーザー</option>
                        <!-- <option value="shop">店舗代表者</option> -->
                        <option value="admin">管理者</option>
                    </select>
                    <div class="form_error">
                        @error('role')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div align="right" class="form_field">
                    <button class="form_button" type="submit">登録</button>
                </div>
            </form>
        </div>


    </div>
</main>

@endsection