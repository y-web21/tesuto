<form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" accept="image/png, image/jpeg">
    {{-- <input type="file" name="image" accept="image/*"> --}}
    @error('image'){{ $message }}
    @enderror
    <input type="submit" value="アップロード">
</form>


@foreach ($images as $image)
    <div style="display:inline-block;">
        <figure style="">
            <a href="{{ route('image.show', $image->id) }}"><img width=200
                    src="{{ asset('/storage/images/' . $image->name) }}" alt="{{ $image->description }}"></a>
            <figcaption>{{ $image->description }}</figcaption>
        </figure>
        <form action={{ route('image.del-req') }} method="post" style="display:inline-block;">
            @csrf
            <input type="hidden" name="id" value="{{ $image->id }}">
            <button type="submit">削除</button>
        </form>
    </div>
@endforeach

{{ $images->links('layouts.paginator.default') }}
{{-- {{ $images->links() }} --}}
