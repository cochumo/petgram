@extends('layouts.layout')

@section('content')
    <form action="{{ $photo->id }}" method="post">
        @csrf
        <img src="{{ url($read_img_path . $photo->filename) }}" class="form_img">
        <input type="hidden" name="id" value="{{ $photo['id'] }}">
        <h3>ファイル名</h3>
        <p>{{ $photo['filename'] }}</p>
        <input type="hidden" name="filename" value="{{ $photo['filename'] }}">
        <h3>メッセージ</h3>
        <input type="text" name="message" value="{{ $photo['message'] }}">
        <input type="submit" name="action" class="btn btn-warning btn-sm btn-dell" value="編集">
    </form>
@endsection
