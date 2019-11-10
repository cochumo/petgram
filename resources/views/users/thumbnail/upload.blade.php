@extends('layouts.layout')

@section('content')
    <h1 class="c-form__authTtl">サムネイルのアップロード</h1>
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
        <form action="{{ route('thumbnail.process', [auth()->user()->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="c-buttonWrap--file">
                <label for="file_upload" class="c-button__file">
                    <input type="file" id="file_upload" name="thumbnail">
                </label>
            </div>
            <div class="u-flxJCnt">
                <input type="submit" value="確認" class="c-button--01">
            </div>
        </form>
    </div>
@endsection
