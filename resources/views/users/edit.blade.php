@extends('layouts.app')

@section('content')
    <x-back title="Ediçao de usuários" route="users"></x-back>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror " id="name"
                           name="name" value="{{ $user->name ?? old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror " id="email"
                           name="email" value="{{ $user->email ?? old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror " id="password"
                           name="password" value="{{ old('password') }}">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">{{ __('Confirm Password') }}</label>
                    <input type="password" class="form-control @error('confirm-password') is-invalid @enderror"
                           id="confirm-password" name="confirm-password" value="{{ old('confirm-password') }}">
                    @error('confirm-password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_blocked"
                               @if($user->is_blocked) checked @endif >
                        <label class="form-check-label">
                            {{ __('Blocked')}}
                        </label>
                    </div>

                </div>


                <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
            </form>
        </div>

        <div class="card-footer d-flex justify-content-end">

            @if( auth()->user()->can("users.destroy") && auth()->id() !== $user->id || auth()->user()->isAdmin() )
                <a class="btn btn-danger " href="#"
                   onclick="event.preventDefault(); document.getElementById('remove-form-{{$user->id}}').submit();">
                    <i class="bi bi-trash"></i> {{ __('Remove') }}
                </a>

                <form id="remove-form-{{$user->id}}"
                      action="{{route('users.destroy', $user->id)}}" method="POST"
                      class="d-none">
                    @csrf
                    @method("DELETE")
                </form>

            @endif

        </div>

    </div>
@endsection
