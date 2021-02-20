{{ asset('') }}
{{ asset('/storage/images/' . $uploaded_image->name) }}
        <button type="button" onclick="javascript:history.back();">戻る</button>

<p><img src="{{ asset('/storage/images/' . $uploaded_image->name) }}"></p>
