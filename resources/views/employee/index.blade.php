@extends('layout.main')

@section('content')

    <x-nav />   
    
    @include('layout.flashMessages')

    <div class="rest-body">

        <div class="dropdown mb-3">
            <button class="btn-secondary right-dropdowns-btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;padding: 5px;">
                {{request('search') ?? 'Sort By Status'}}
                <span class="dropdown-toggle "></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{ route('employees.index') }}">All</a></li>
                <li><a class="dropdown-item" href="{{ route('employees.index') }}?search=Approved">Approved</a></li>
                <li><a class="dropdown-item" href="{{ route('employees.index') }}?search=Rejected">Rejected</a></li>
            </ul>
        </div>

        <table class="table table-striped">
        <tr>
            <th>Subject</th>
            <th>Description</th>
            <th>Dates</th>
            <th>Status</th>
        </tr>

        @if ($leaves->count()>0)
            @foreach ($leaves as $leave)
                <tr>
                    <td>{{$leave->subject}}</td>
                    <td>{{$leave->description}}</td>
                    <td>{{$leave->dates}}</td>
                    <td>{{$leave->status}}</td>
                </tr>
            @endforeach
        @else
            </table>
            <h2 style="text-align: center">No Leave Exist</h2>
        @endif
    </table>
    </div>

@endsection