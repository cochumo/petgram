@extends('layout')

@section('content')
    <form action="create_complete" method="post">
        @csrf
        <img src="{{ asset($data['read_temp_path']) }}" class="form_img">
        <h3>ファイル名</h3>
        <p>{{ $data['filename'] }}</p>
        <h3>メッセージ</h3>
        <p>{{ $data['message'] }}</p>
        <input type="submit" name="action" value="投稿">
    </form>
@endsection
