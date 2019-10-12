@extends('layout')

@section('content')
    <form action="create_complete" method="post">
        @csrf
        <img src="{{ asset($data['read_temp_path']) }}" class="form_img">
        <ul class="c-form__inputWrap">
            <li class="c-form__inputList">
                <h3 class="c-form__title">ファイル名</h3>
                <p class="c-form__input--text">{{ $data['filename'] }}</p>
            </li>
            <li class="c-form__inputList">
                <h3 class="c-form__title">メッセージ</h3>
                <p class="c-form__input--text">{{ $data['message'] }}</p>
            </li>
        </ul>
        <div class="u-flxJCnt">
            <input type="submit" name="action" value="投稿" class="c-button--01">
        </div>
    </form>
@endsection
