@extends('layouts.layout')

@section('styles')
    <script src="https://kit.fontawesome.com/322edd454d.js" crossorigin="anonymous"></script>
@endsection

@section('content')
    <div class="p-detail__header">
        <a href="{{ url()->previous() }}" class="p-detail__header__back">◀戻る</a>
        @if($photo->user->id == auth()->user()->id)
            <div id="menu_opan_btn" class="p-detail__header__menuLinkBtn">
                <i class="fas fa-ellipsis-h fa-2x"></i>
            </div>
            <nav id="header_menu_wrap" class="p-detail__header__menuWrap" style="display: none;">
                <div id="header_menu_btn_wrap" class="p-detail__header__menuBtnWrap" style="display: none;">
                    <a href="{{ route('photos.edit', [$photo->id]) }}" class="p-detail__header__menuBtn">編集</a>
                    <a id="post_delete" class="p-detail__header__menuBtn">削除</a>
                    <a id="menu_close_btn" class="p-detail__header__menuBtn">▲閉じる</a>
                </div>
            </nav>
            <form action="{{ route('photos.destroy', [ $photo->id ]) }}" method="post" id="delete-form" class="u-dispN">
                @csrf
                <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
            </form>
        @endif
    </div>
    <div class="p-detail__main">
        <div class="p-detail__main__photoInfoWrap">
            <div class="p-detail__main__thumbnail">
                <img src="{{ asset('/img/default_thumbnail.svg') }}" alt="" class="p-detail__main__comment__img">
            </div>
            <div class="p-detail__main__photoInfo">
                <h1 class="p-detail__main__name__txt">{{ $photo->user->name }}</h1>
                <h2 class="p-detail__main__comment__txt">{{ $photo['message'] }}</h2>
            </div>
        </div>
        <img src="{{ url($photo->url) }}">
    </div>
    <div class="c-modalWrap" id="photo_delete">
        <div class="c-modal__overLay c-modal__close">
            <div class="c-modal__inner">
                <div class="c-modal__header">
                    <h3 class="">投稿削除の確認</h3>
                </div>
                <div class="c-modal__main">
                    <p class="">
                        この投稿を削除しますか？
                    </p>
                </div>
                <div class="c-modal__footer">
                    <button class="c-button__no--01 c-modal__close">キャンセル</button>
                    <a id="finished_confirmation" class="c-button__yes--02">OK</a>
                </div>
            </div>
        </div>
    </div>
@endsection
