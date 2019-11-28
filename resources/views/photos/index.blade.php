@extends('layouts.layout')

@section('content')
    <div class="">
        <ul class="l-main__categoryWrap">
            <li class="l-main__categoryList selected">タイムライン</li>
            <a href="{{ route('search.collection') }}" class="l-main__categoryList">コレクション</a>
            <a href="{{ route('search.mypost') }}" class="l-main__categoryList">マイ投稿</a>
        </ul>
    </div>
    <div class="l-main__pagenation">
        {{ $photos->links() }}
    </div>
    <div id="grid" class="c-gridWrap">
        @foreach($photos as $photo)
            <a href="{{ route('photos.show', [ $photo->id ]) }}" id="{{ pathinfo($photo->filename, PATHINFO_FILENAME) }}" class="c-grid__list">
                <img src="{{ url($photo->url) }}" class="c-grid__img">
            </a>
        @endforeach
    </div>
    <div class="l-main__pagenation l-main__bottomPagenation">
        {{ $photos->links() }}
    </div>
    @if(url()->previous() == route('register'))
        <div class="c-modalWrap u-fadeIn" id="welcome">
            <div class="c-modal__overLay c-modal__close">
                <div class="c-modal__inner">
                    <div class="c-modal__header">
                        <h3 class="">会員登録完了</h3>
                    </div>
                    <div class="c-modal__main">
                        <p class="">
                            ようこそ、Petgramへ<br>
                            会員登録が完了しました！
                        </p>
                        <img src="{{ asset('img/icon-complete.svg') }}" alt="" class="">
                    </div>
                    <div class="c-modal__footer">
                        <button id="advance" class="c-button__yes--03">OK</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
