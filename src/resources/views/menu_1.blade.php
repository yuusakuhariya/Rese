@extends('layouts.menu')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/menu_1.css') }}" />
@endsection

@section('content')

<main>
    <div class="container">
        <div class="content">
            <div class="massage"><a href="">Home</a></div>
            <div class="massage"><a href="">Logout</a></div>
            <div class="massage"><a href="">Mypage</a></div>
        </div>
    </div>
</main>

@endsection