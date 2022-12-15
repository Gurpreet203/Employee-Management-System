@extends('layout.main')

@section('content')
    <x-nav />
    @include('layout.flashMessages')
    <form action="{{ route('users.store') }}" method="POST" class="my-forms">
        @csrf
        <h2>Create User</h2>
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control form-control-sm" value="{{ old('first_name') }}" required>
            <x-error name="first_name" />
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control form-control-sm"  value="{{ old('last_name') }}" required>
            <x-error name="last_name" />
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control form-control-sm" value="{{ old('email') }}" required>
            <x-error name="email" />
        </div>

        <div class="mb-3">
            <button type="submit" value="save" name="save" class="btn btn-secondary">Invite User</button>
            <button type="submit" value="save_another" name="save" class="btn btn-secondary">Invite User & Invite Another</button>        
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection