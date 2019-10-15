@extends('layouts.layout')

@section('content')
    <div class="l-main__pagenation">
        {{ $photos->links() }}
    </div>
    <div id="grid" class="c-gridWrap">
        @foreach($photos as $photo)
            <a href="{{ url('photos/post/' . $photo->id) }}" id="{{ pathinfo($photo->filename, PATHINFO_FILENAME) }}" class="c-grid__list">
                <img src="{{ url($read_img_path . $photo->filename) }}" class="c-grid__img">
            </a>
        @endforeach
    </div>
    <div class="l-main__pagenation">
        {{ $photos->links() }}
    </div>
@endsection
