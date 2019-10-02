@extends('layout')

@section('content')
    <div class="">
        <img src="{{ url($read_img_path . $photo->filename) }}">
        <form action="/photos/delete/{{ $photo->id }}" method="post">
            @csrf
            <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
        </form>
    </div>
@endsection
