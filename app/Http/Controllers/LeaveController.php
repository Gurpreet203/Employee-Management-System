<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LeaveController extends Controller
{
    public function index()
    {
        return view('users.leaves', [
            'leaves' => Leave::where('status', 'Pending')
                ->with('user')
                ->get()
        ]);
    }

    public function show()
    {
        return view('users.leaves-list', [
            'leaves' => Leave::with('user')->get()
        ]);
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $dates = json_decode(Leave::LatestLeaveDates()->leave_dates);
        $dateRange = CarbonPeriod::create($dates->start_date, $dates->end_date);

        $dateRange = collect($dateRange)
            ->map(function($date) {
                return $date->format('Y-m-d');
            })->toArray();

        $attributes = $request->validate([
            'subject' => 'required|min:3|max:255',
            'description' => 'required|min:5',
            'start_date' => ['required', 'after:now', Rule::notIn($dateRange)],
            'end_date' => ['required', 'after:start_date', Rule::notIn($dateRange)],
        ], [
            'start_date.after' => 'Please select the date after Today',
            'end_date.after' => 'Please select the date after Starting date',
        ]);

        $attributes += [
            'user_id' => Auth::id(),
            'leave_dates' => json_encode([
                    'start_date' => $attributes['start_date'],
                    'end_date' => $attributes['end_date']
                ])
        ];

        Leave::create($attributes);

        return to_route('employee.index')->with('success', 'Leave sent To Admin');
    }
}
