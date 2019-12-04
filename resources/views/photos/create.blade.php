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
            <div class="c-form__Wrap">
                <div class="c-form__photoWrap">
                    <div class="c-buttonWrap--file">
                        <label for="file_upload" class="c-button__file">
                            <input type="file" id="file_upload" name="photo">
                        </label>
                    </div>
                </div>
                <div class="c-form__textWrap">
                    <ul class="c-form__inputWrap">
                        <li class="c-form__inputList">
                            <h3 class="c-form__title">タグ</h3>
                            <ul class="c-form__tagsWrap">
                                @foreach($tags as $tag)
                                    <li class="c-form__tagsList">
                                        <input type="checkbox" name="tags[]" id="{{ $tag->id }}" value="{{ $tag->name }}">
                                        <label for="{{ $tag->id }}">{{ $tag->name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                            <h3 class="c-form__title">追加タグ</h3>
                            <input type="text" name="tags[]" class="c-form__inputTags--text">
                            <input type="text" name="tags[]" class="c-form__inputTags--text">
                            <input type="text" name="tags[]" class="c-form__inputTags--text">
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
                </div>
            </div>
        </form>
    </div>
@endsection
