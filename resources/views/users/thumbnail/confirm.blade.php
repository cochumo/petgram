@extends('layouts.layout')

@section('content')
    <form action="{{ route('thumbnail.update', [auth()->user()->id]) }}" method="post">
        @csrf
        <div class="l-main__thumbnail__confirm">
            <div>
                <div class="u-flxJCnt">
                    <img src="{{ asset($data['preview_img']) }}" class="l-main__thumbnailImg--01">
                </div>
                <div class="u-flxJCnt u-pT2 u-pB1">
                    <input type="submit" value="変更" class="c-button--01">
                </div>
            </div>
        </div>
    </form>
@endsection
