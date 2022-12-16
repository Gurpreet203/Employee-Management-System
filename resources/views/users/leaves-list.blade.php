@extends('layout.main')

@section('content')
    <x-nav />
    @include('layout.flashMessages')

    <div class="rest-body">
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