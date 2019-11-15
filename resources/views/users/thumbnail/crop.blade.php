@extends('layouts.layout')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.0.0/cropper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.0.0/cropper.min.css">
@endsection

@section('content')
    <form action="{{ route('thumbnail.confirm', [auth()->user()->id]) }}" method="post">
        @csrf
        <div>
            <div id="crop_imgArea">
                <img src="{{ asset($data['preview_img']) }}" id="crop_image" class="">
            </div>
            <div class="">
                <input id="x" name="x" type="hidden" value="">
                <input id="y" name="y" type="hidden" value="">
                <input id="width" name="width" type="hidden" value="">
                <input id="height" name="height" type="hidden" value="">
            </div>
            <div id="crop_btnArea" class="u-flxJCnt u-pT1 u-pB1">
                <a href="{{ route('thumbnail.edit') }}" class="c-button--05">戻る</a>
                <input type="submit" value="切り取る" class="c-button--01">
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.0.0/cropper.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/4.0.0/cropper.min.js" defer></script>
@endsection
