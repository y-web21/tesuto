
    <form action="{{ route('image.post')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="featured_image" accept="image/png, image/jpeg">>
        <input type="submit" value="やっちゃえ!">

    </form>
