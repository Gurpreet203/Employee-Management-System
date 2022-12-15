@extends('layout.main')

@section('content')
    <x-nav />
    <form action="{{ route('users.update',$user->slug) }}" method="POST" class="my-forms">
        @csrf
        @method('PUT')
        <h1>Edit Account</h1>
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" value="{{$user->first_name}}" class="form-control form-control-sm" required>
            <x-error name="first_name" />
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" value="{{$user->last_name}}" class="form-control form-control-sm" required>
            <x-error name="last_name" />
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" value="{{$user->email}}" disabled class="form-control form-control-sm">
        </div>
        
        
        <button type="submit" name="update" class="btn btn-secondary">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
        
    </form>
@endsection