<form action="create_complete" method="post">
    @csrf
    <img src="{{ asset($data['read_temp_path']) }}" class="form_img">
    <p>ファイル名</p>
    <p>{{ ($data['temp_filename']) }}</p>
    <input type="submit" name="action" value="投稿">
</form>
