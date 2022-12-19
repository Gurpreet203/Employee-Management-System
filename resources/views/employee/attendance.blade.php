@extends('layout.main')

@section('content')
    <x-nav />
    <div class="rest-body">

        <div class="m-3" style="text-align: center">
            <h2>Total Penality = &#8377; {{$penalities->sum('penality')}}</h2>
        </div>
        <table class="table table-striped">
            <tr>
                <th>Date</th>
                <th>Status</th>
            </tr>

        @if ($attendances->count()>0)
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{$attendance->date}}</td>
                    <td>{{$attendance->status}}</td>
                </tr>
            @endforeach
        @else
            </table>
            <h2 style="text-align: center">No Attendance Exist</h2>
        @endif
        </table>
    </div>
@endsection