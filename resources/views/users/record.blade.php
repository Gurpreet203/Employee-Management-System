@extends('layout.main')

@section('content')

    <x-nav />
    
    <a href="{{ route('users.index') }}">Go Back</a>

    <div class="rest-body">

         <form action="{{ route('users.attendence', $user) }}?{{request()->getQueryString()}}" method="get">
            <div class="d-flex mb-5">
                <input class="form-control" type="text" name="search" placeholder="Search By Day, Month or Year" value="{{request('search')}}">
            </div>
        </form>

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