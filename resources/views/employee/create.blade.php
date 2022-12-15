@extends('layout.main')

@section('content')
    <x-nav />
    @include('layout.flashMessages')
    <form action="{{ route('leaves.store') }}" method="POST" class="my-forms">
        @csrf
        <h2>Create Leave</h2>
        <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control form-control-sm" value="{{ old('subject') }}" required placeholder="Subject">
            <x-error name="subject" />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="" class="form-control" placeholder="Description" required>{{ old('description') }}</textarea>
            <x-error name="description" />
        </div>
        <div class="row g-3 mb-3">
            <div class="col-sm-7">
                <label for="start_date" class="form-label">Start Leave Date</label>
                <input type="date" class="form-control" name="start_date" placeholder="To" required>
                <x-error name="start_date" />
            </div>
            <div class="col-sm">
                <label for="end_date" class="form-label">End Leave Date</label>
                <input type="date" class="form-control" name="end_date" placeholder="From" required>
                <x-error name="end_date" />
            </div>
        </div>

        <div class="mb-3">
            <button type="submit" value="save" name="save" class="btn btn-secondary">Generate Leave</button>
            <a href="{{ route('employee.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
@endsection