@extends('layout')

@section('content')
    <div id="grid" class="c-grid--area">
        @foreach($photos as $photo)
            <a href="{{ url('photos/post/' . $photo->id) }}" id="{{ pathinfo($photo->filename, PATHINFO_FILENAME) }}" class="c-grid">
                <img src="{{ url($read_img_path . $photo->filename) }}">
            </a>
        @endforeach
    </div>
    <div class="">
        {{ $photos->links() }}
    </div>
@endsection
