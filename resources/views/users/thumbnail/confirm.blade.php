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
{{--                    <button type="submit" name="action" value="back" class="c-button--05">修正</button>--}}
                    <button type="submit" name="action" value="submit" class="c-button--01">変更</button>
                </div>
            </div>
        </div>
    </form>
@endsection
