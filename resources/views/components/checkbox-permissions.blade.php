@foreach ($permissions as $permission)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="{{ $permission->name }}" name="permission[]"
            @if ($role->permissions->contains($permission)) checked @endif>
        <label class="form-check-label" for="permission">
            {{ $permission->name }}
        </label>
    </div>
@endforeach
