@extends('layouts.layout')

@section('content')
    <div class="l-main__content">
        <form action="{{ route('photos.complete') }}" method="post">
            @csrf
            <img src="{{ asset($data['read_temp_path']) }}" class="form_img">
            <ul class="c-form__inputWrap">
                <li class="c-form__inputList">
                    <h3 class="c-form__title">メッセージ</h3>
                    <p class="c-form__input--text">{{ $data['message'] }}</p>
                </li>
            </ul>
            <div class="u-flxJCnt">
                <input type="submit" name="action" value="投稿" class="c-button--01">
            </div>
        </form>
    </div>

    <div class="c-modalWrap" id="leave-pages">
        <div class="c-modal__overLay c-modal__close">
            <div class="c-modal__inner">
                <div class="c-modal__header">
                    <h3 class="">ページの離脱確認</h3>
                </div>
                <div class="c-modal__main">
                    <p class="">
                        ページを離れるとアップロードした<br>
                        画像が削除されます。<br>
                        よろしいですか？
                    </p>
                </div>
                <div class="c-modal__footer">
                    <button class="c-button__no--01 c-modal__close">キャンセル</button>
                    <a href="{{ route('photos.index') }}" id="finished_confirmation" class="c-button__yes--01">OK</a>
                </div>
            </div>
        </div>
    </div>
@endsection
