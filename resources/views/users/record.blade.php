@extends('layout.main')

@section('content')

    <x-nav />
    
    <a href="{{ route('users.index') }}">Go Back</a>

    <div class="rest-body">

        <div class="d-flex" style="justify-content: space-between">
            <form action="{{ route('users.attendence', $user) }}?{{request()->getQueryString()}}" method="get">
            <div class="d-flex mb-5">
                <input class="form-control" type="text" name="search" placeholder="Search By Day, Month or Year" value="{{request('search')}}">
            </div>
        </form>
        <div>
            <div class="dropdown mb-3">
            <button class="btn-secondary right-dropdowns-btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;padding: 5px;">
                {{request('search') ?? 'Sort By Status'}}
                <span class="dropdown-toggle "></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{ route('users.attendence', $user) }}">All</a></li>
                <li><a class="dropdown-item" href="{{ route('users.attendence', $user) }}?sort=Leave">Leave</a></li>
                <li><a class="dropdown-item" href="{{ route('users.attendence', $user) }}?sort=Present">Present</a></li>
                <li><a class="dropdown-item" href="{{ route('users.attendence', $user) }}?sort=Absent">Absent</a></li>
            </ul>
        </div>
        </div>
         </div>

        <table class="table table-striped">
        <tr>
            <th>Date</th>
            <th>Attendence</th>
        </tr>

        @if ($attendences->count()>0)
            @foreach ($attendences as $attendence)
                <tr>
                    <td>{{$attendence->date}}</td>
                    <td>{{$attendence->status}}</td>
                </tr>                
            @endforeach
        @else
            </table>
            <h2>No Record Found</h2>
        @endif
    </table>
    </div>
    
@endsection