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
                <th>Reason</th>
                <th>Penality (in rupees)</th>
            </tr>

        @if ($penalities->count()>0)
            @foreach ($penalities as $penality)
                <tr>
                    <td>{{$penality->date}}</td>
                    <td>{{$penality->status}}</td>
                    <td>&#8377; {{$penality->penality}}</td>
                </tr>
            @endforeach
        @else
            </table>
            <h2 style="text-align: center">Congratulations You Have No Penality</h2>
        @endif
        </table>
    </div>
@endsection