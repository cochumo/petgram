@extends('layouts.layout')

@section('content')
    <div class="">
        <ul class="l-main__categoryWrap">
{{--            <a href="{{ route('photos.index') }}" class="l-main__categoryList">タイムライン</a>--}}
            <li class="l-main__categoryList">タグ</li>
{{--            <a href="{{ route('search.mypost') }}" class="l-main__categoryList selected">マイ投稿</a>--}}
        </ul>
    </div>
{{--    <div class="l-main__pagenation">--}}
{{--        {{ $photos->links() }}--}}
{{--    </div>--}}
    <div id="grid" class="c-gridWrap">
        @foreach($tag->photos as $photo)
            <a href="{{ route('photos.show', [ $photo->id ]) }}" id="{{ pathinfo($photo->filename, PATHINFO_FILENAME) }}" class="c-grid__list">
                <img src="{{ url($photo->url) }}" class="c-grid__img">
            </a>
        @endforeach
    </div>
    <div class="l-main__pagenation l-main__bottomPagenation">
        {{ $tag->photos->links() }}
    </div>
@endsection
