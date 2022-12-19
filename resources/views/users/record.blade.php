@extends('layout.main')

@section('content')

    <x-nav />
    
    <a href="{{ route('users.index') }}">Go Back</a>

    <div class="rest-body">
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