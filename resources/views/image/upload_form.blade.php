<form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="email" value="{{ old('email') }}">
    <input type="file" name="image" accept="image/png, image/jpeg">
    <input type="submit" value="やっちゃえ!">
</form>
