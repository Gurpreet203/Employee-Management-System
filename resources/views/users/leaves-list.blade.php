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
                <li><a class="dropdown-item" href="{{ route('leaves.show') }}">All</a></li>
                <li><a class="dropdown-item" href="{{ route('leaves.show') }}?search=Approved">Approved</a></li>
                <li><a class="dropdown-item" href="{{ route('leaves.show') }}?search=Rejected">Rejected</a></li>
            </ul>
        </div>

        <table class="table table-striped">
        <tr>
            <th>Requested By</th>
            <th>Subject</th>
            <th>Description</th>
            <th>Dates</th>
            <th>status</th>
        </tr>

        @if ($leaves->count()>0)

            @foreach ($leaves as $leave)

                <tr>
                    <td><b>{{$leave->user->name}}</b></td>
                    <td>{{$leave->subject}}</td>
                    <td>{{$leave->description}}</td>
                    <td>{{$leave->dates}}</td>
                    <td>{{$leave->status}}</td>                    
                </tr>
                
            @endforeach
        @else
            </table>
            <h2>No Leaves Approved or Rejected</h2>
        @endif
    </table>
    </div>
    
@endsection