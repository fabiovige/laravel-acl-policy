@foreach ($rows as $row)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="{{ $row->name }}"
            name="{{$name}}[]" @if ($contains->contains($row)) checked @endif>
        <label class="form-check-label">
            {{ $row->name }}
        </label>
    </div>
@endforeach
