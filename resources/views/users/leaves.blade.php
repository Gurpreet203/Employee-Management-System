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
            <th>Reject</th>
            <th>Approved</th>
        </tr>

        @if ($leaves->count()>0)

            @foreach ($leaves as $leave)

                <tr>
                    <td><b>{{$leave->user->name}}</b></td>
                    <td>{{$leave->subject}}</td>
                    <td>{{$leave->description}}</td>
                    <td>{{$leave->dates}}</td>
                    <td><a href="{{route('leaves.status', $leave)}}?status=Rejected" class="btn btn-outline-danger m-1">Reject</a></td>
                    <td><a href="{{route('leaves.status', $leave)}}?status=Approved" class="btn btn-outline-success">Approved</a></td>
                    
                </tr>
                
            @endforeach
        @else
            </table>
            <h2>No Leaves Pending</h2>
        @endif
    </table>
    </div>
    
@endsection