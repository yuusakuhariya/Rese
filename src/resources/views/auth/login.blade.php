@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/login.css') }}" />
@endsection

@section('content')

<main>
    <div class="container">
        <div class="content_title">
            <div class="content_title_registration">login</div>
        </div>
        <div class="form">
            <form class="form_register" action="" method="">
                <div class="form_field">
                    <span><img src="/image/man.svg"></span><input class="input_name" type="name" name="name" placeholder="Username" value="">
                </div>
                <div class="form_field">
                    <span><img src="/image/mail.svg"></span><input class="input_email" type="email" name="email" placeholder="Email" value="">
                </div>
                <div align="right" class="form_field">
                    <button class="form_button" type="button">ログイン</button>
                </div>
            </form>
        </div>


    </div>
</main>

@endsection