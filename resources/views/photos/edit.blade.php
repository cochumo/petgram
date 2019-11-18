@extends('layouts.layout')

@section('content')
    <div class="l-main__content">
        <form action="{{ route('photos.update', [ $photo->id ]) }}" method="post">
            @csrf
            <img src="{{ url($photo->url) }}" class="form_img">
            <ul class="c-form__inputWrap">
                <li class="c-form__inputList">
                    <h3 class="c-form__title">メッセージ</h3>
                    <textarea rows="2" name="message" class="c-form__input--text">{{ $photo['message'] }}</textarea>
                </li>
            </ul>
            <div class="u-flxJCnt">
                <input type="submit" name="action" value="変更" class="c-button--01">
            </div>
        </form>
    </div>
@endsection
