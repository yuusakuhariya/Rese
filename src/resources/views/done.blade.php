@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/done.css') }}" />
@endsection

@section('content')

<main>
    <div class="container">
        <div class="content">
            <div class="content_message">
                ご予約ありがとうございます
            </div>
            <div class="content_message_back"><a href="">戻る</a></div>
        </div>
    </div>
</main>

@endsection