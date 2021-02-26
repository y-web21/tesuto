@if (!isset($checked))
    {{ $checked = -1 }}
@endif

@foreach ($statuses as $status)
    <input type="radio" name="status_id" id="rb_status_{{ $status->status_id }}" value={{ $status->status_id }}
        {{ $status->status_id === $checked ? 'checked' : '' }}>
    <label for="rb_status_{{ $status->status_id }}">{{ $status->status_name }}</label>
@endforeach
