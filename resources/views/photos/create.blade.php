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
        <form action="create_confirm" method="post" enctype="multipart/form-data">
            @csrf
            <div class="c-buttonWrap--file">
                <label for="file_upload" class="c-button__file">
                    <input type="file" id="file_upload" name="photo">
                </label>
            </div>
            <ul class="c-form__inputWrap">
                <li class="c-form__inputList">
                    <h3 class="c-form__title">コメント</h3>
                    <input type="text" name="message" class="c-form__input--text">
                </li>
            </ul>
            <div class="u-flxJCnt">
                <input type="submit" value="確認" class="c-button--01">
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        // こっちに書くと動かない
        // $(window).on('load',function(){
        //     file_preview();
        // });
    </script>
@endsection
