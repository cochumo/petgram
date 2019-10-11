@extends('layout')

@section('content')
    <div id="grid" class="c-gridWrap">
        @foreach($photos as $photo)
            <a href="{{ url('photos/post/' . $photo->id) }}" id="{{ pathinfo($photo->filename, PATHINFO_FILENAME) }}" class="c-grid__list">
                <img src="{{ url($read_img_path . $photo->filename) }}" class="c-grid__img">
            </a>
        @endforeach
    </div>
    <div class="c-pagenation">
        {{ $photos->links() }}
    </div>
@endsection
