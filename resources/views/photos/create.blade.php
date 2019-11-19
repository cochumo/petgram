@extends('layouts.layout')

@section('content')
    <div class="l-main__content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('photos.confirm') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="c-buttonWrap--file">
                <label for="file_upload" class="c-button__file">
                    <input type="file" id="file_upload" name="photo">
                </label>
            </div>
{{--            <span class="c-form__preview"></span>--}}
            <ul class="c-form__inputWrap">
                <li class="c-form__inputList">
                    <h3 class="c-form__title">タグ</h3>
                    <div class="">
                        @foreach($tags as $tag)
                            <div class="">
                                <input type="checkbox" name="tags[]" id="{{ $tag->id }}" value="{{ $tag->name }}">
                                <label for="{{ $tag->id }}">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </li>
                <li class="c-form__inputList">
                    <h3 class="c-form__title">コメント</h3>
                    <p class="c-form__note">40文字以内でご入力ください。</p>
                    <textarea rows="2" name="message" class="c-form__input--text"></textarea>
                </li>
            </ul>
            <div class="u-flxJCnt">
                <input type="submit" value="確認" class="c-button--01">
            </div>
        </form>
    </div>
@endsection
