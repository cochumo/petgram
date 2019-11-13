@extends('layouts.layout')

@section('content')
    <form action="{{ route('thumbnail.update', [auth()->user()->id]) }}" method="post">
        @csrf
        <div>
            <div>
                <img src="{{ asset($data['preview_img']) }}" class="">
            </div>
            <div class="u-flxJCnt u-pT1 u-pB1">
                <input type="submit" value="変更" class="c-button--01">
            </div>
        </div>
    </form>
@endsection
