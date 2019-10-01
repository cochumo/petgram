@extends('layout')

@section('content')
    <div id="grid" class="c-grid--area">
        @foreach($photos as $photo)
            <div id="{{ pathinfo($photo->filename, PATHINFO_FILENAME) }}" class="c-grid">
                <img src="{{ $read_img_path . $photo->filename }}">
            </div>
        @endforeach
    </div>
    <div id="modal" class="c-modal--area">
        @foreach($photos as $photo)
            <div id="{{ "modal_" . pathinfo($photo->filename, PATHINFO_FILENAME) }}" class="c-modal">
                <div id="modal_header" class="">

                </div>
                <div id="modal_main" class="">
                    <img src="{{ $read_img_path . $photo->filename }}">
                </div>
                <div id="modal_footer" class="">
                    <div>
                        <form action="/photos/delete/{{ $photo->id }}" method="post">
                            @csrf
                            <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
