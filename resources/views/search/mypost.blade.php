@extends('layouts.layout')

@section('content')
    <div class="">
        <ul class="l-main__categoryWrap">
            <a href="{{ route('photos.index') }}" class="l-main__categoryList">タイムライン</a>
            <li class="l-main__categoryList">コレクション</li>
            <li class="l-main__categoryList selected">マイ投稿</li>
        </ul>
    </div>
    <div class="l-main__pagenation">
        {{ $photos->links() }}
    </div>
    <div id="grid" class="c-gridWrap">
        @foreach($photos as $photo)
            <a href="{{ route('photos.show', [ $photo->id ]) }}" id="{{ pathinfo($photo->filename, PATHINFO_FILENAME) }}" class="c-grid__list">
                <img src="{{ url($photo->url) }}" class="c-grid__img">
            </a>
        @endforeach
    </div>
    <div class="l-main__pagenation l-main__bottomPagenation">
        {{ $photos->links() }}
    </div>
@endsection
