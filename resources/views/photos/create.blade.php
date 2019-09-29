@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="create_confirm" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="photo">
    <input type="submit" value="確認">
</form>
