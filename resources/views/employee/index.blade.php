@extends('layout.main')

@section('content')

    <x-nav />   
    
    @include('layout.flashMessages')

    <div class="rest-body">
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