@extends('layouts.layout')

@section('content')
    <aside class="p-detail__header">
        <a href="#" class="p-detail__header__back">◀戻る</a>
        <div class="p-detail__header__menuBtn js-detail__header__menuBtn">
            <span class="p-detail__header__menuBtn__circle"></span>
            <span class="p-detail__header__menuBtn__circle"></span>
            <span class="p-detail__header__menuBtn__circle"></span>
        </div>
        <nav class="p-detail__header__menuWrap" style="display: none;">
            <a href="#">編集</a>
            <a href="#">投稿の削除</a>
            <a href="#">▲閉じる</a>
        </nav>
    </aside>
    <article class="p-detail__main">
        <div class="p-detail__main__commentWrap">
            <img src="/img/icon-mypage.svg" alt="猫狂いのケン" class="p-detail__main__comment__img">
            <h1 class="p-detail__main__comment__txt">ダミーダミーダミーダミーダミーダミーダミーダミーダミー</h1>
        </div>
        <img src="{{ url($read_img_path . $photo->filename) }}">
        <h3>メッセージ</h3>
        <p>{{ $photo['message'] }}</p>
        <form action="/photos/delete/{{ $photo->id }}" method="post">
            @csrf
            <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
        </form>
        <a href="/photos/edit/{{ $photo->id }}" class="btn btn-warning btn-sm btn-dell">編集</a>
    </article>
@endsection
