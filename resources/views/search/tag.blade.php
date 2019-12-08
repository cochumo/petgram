@extends('layouts.layout')

@section('content')
    <div class="l-main__tag--ttlWrap">
        <h1 class="l-main__tag--ttl">{{ $tag->hashtag }}</h1>
    </div>
    <div class="l-main__tag--infoWrap">
        <div class="">
            <img src="{{ asset($tag->photos()->first()->url) }}" class="l-main__tagThumbnail--img">
        </div>
        <p class="l-main__tag--txt">{{ $tag->photos()->count() }}件</p>
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
