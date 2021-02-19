@foreach ($statuses as $status)
@if ($status->status_id === $default_check)
    <input type="radio" name="status_id" id="rb_status_{{ $status->status_id }}" value={{ $status->status_id }} checked>
    <label for="rb_status_{{ $status->status_id }}">{{ $status->status_name }}</label>
@else
    <input type="radio" name="status_id" id="rb_status_{{ $status->status_id }}" value={{ $status->status_id }}>
    <label for="rb_status_{{ $status->status_id }}">{{ $status->status_name }}</label>
@endif
@endforeach
