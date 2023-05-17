@foreach ($rows as $row)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="{{ $row->name }}"
            name="{{$name}}[{{ $row->name }}]" @if ($contains->contains($row)) checked @endif onchange="getValue(this);" >
        <label class="form-check-label">
            {{ $row->name }}
        </label>
    </div>
@endforeach

