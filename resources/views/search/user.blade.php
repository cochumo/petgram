@extends('layouts.layout')

@section('content')
    <div class="l-main__user--ttlWrap">
        <h1 class="l-main__user--ttl">{{ $user->name }}</h1>
    </div>
    <div class="l-main__user--infoWrap">
        <div class="">
            <img src="{{ asset($user->url) }}" class="l-main__userThumbnail--img">
        </div>
        <p class="l-main__user--txt">{{ $user->photos()->count() }}件</p>
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
