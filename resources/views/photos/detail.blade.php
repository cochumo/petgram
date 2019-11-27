@extends('layouts.layout')

@section('content')
    <div class="c-detailWrap">
        <div class="c-detail__header">
            <a href="{{ url()->previous() }}" class="c-detail__header__back">◀戻る</a>
            @if($photo->user->id == auth()->user()->id)
                <div id="menu_opan_btn" class="c-detail__header__menuLinkBtn">
                    <img src="{{ asset('img/icon-menu_btn.svg') }}" class="">
                </div>
                <nav id="header_menu_wrap" class="c-detail__header__menuWrap" style="display: none;">
                    <div id="header_menu_btn_wrap" class="c-detail__header__menuBtnWrap" style="display: none;">
                        <a href="{{ route('photos.edit', [$photo->id]) }}" class="c-detail__header__menuBtn">編集</a>
                        <a id="post_delete" class="c-detail__header__menuBtn">削除</a>
                        <a id="menu_close_btn" class="c-detail__header__menuBtn">▲閉じる</a>
                    </div>
                </nav>
                <form action="{{ route('photos.destroy', [ $photo->id ]) }}" method="post" id="delete-form" class="u-dispN">
                    @csrf
                    <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
                </form>
            @endif
        </div>
        <div class="c-detail__main">
            <a href="{{ route('search.user', [ $photo->user->id ]) }}" class="c-detail__main__photoInfoWrap">
                <div class="c-detail__main__thumbnail">
                    <img src="{{ asset('/img/default_thumbnail.svg') }}" alt="" class="c-detail__main__comment__img">
                </div>
                <div class="c-detail__main__photoInfo">
                    <h1 class="c-detail__main__name__txt">{{ $photo->user->name }}</h1>
                    <h2 class="c-detail__main__comment__txt">{{ $photo['message'] }}</h2>
                </div>
            </a>
            <img src="{{ url($photo->url) }}">
            <div class="c-detail__tagsWrap">
                @foreach($photo->tags as $tag)
                    <a href="{{ route('search.tag', [ $tag->id ]) }}" class="c-detail__tags--text">#{{ $tag->name }}</a>
                @endforeach
            </div>
            <div id="reaction_data" class="c-detail__reactionWrap" url="{{ route('photos.reaction.create') }}" user_id="{{ auth()->user()->id }}" photo_id="{{ $photo->id }}">
                <button id="reaction_btn_1" value="Reaction01" class="c-detail__reaction__btn">
                    <p class="">😄</p>
                </button>
                <button id="reaction_btn_2" value="Reaction02" class="c-detail__reaction__btn">
                    <p class="">🤣</p>
                </button>
                <button id="reaction_btn_3" value="Reaction03" class="c-detail__reaction__btn">
                    <p class="">😊</p>
                </button>
                <button id="reaction_btn_4" value="Reaction04" class="c-detail__reaction__btn">
                    <p class="">😍</p>
                </button>
                <button id="reaction_btn_5" value="Reaction05" class="c-detail__reaction__btn">
                    <p class="">😲</p>
                </button>
            </div>
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
    </div>
@endsection
