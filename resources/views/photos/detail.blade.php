@extends('layout')

@section('content')
    <div class="preview--area">
        <img src="{{ url($read_img_path . $photo->filename) }}">
        <p>{{ $photo['message'] }}</p>
        <form action="/photos/delete/{{ $photo->id }}" method="post">
            @csrf
            <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
        </form>
        <a href="/photos/edit/{{ $photo->id }}" class="btn btn-warning btn-sm btn-dell">編集</a>
    </div>
@endsection
