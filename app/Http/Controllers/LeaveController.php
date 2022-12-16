<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LeaveController extends Controller
{
    // list of only pending leaves

    public function index()
    {
        return view('users.leaves', [
            'leaves' => Leave::pendingLeaves()
                ->with('user')
                ->get()
        ]);
    }

    // list of all leaves except pending leaves

    public function show()
    {
        return view('users.leaves-list', [
            'leaves' => Leave::with('user')
                ->whereNot('status', Leave::PENDING)
                ->get()
        ]);
    }

    // employee create leaves

    public function create()
    {
        return view('employee.leaves.create');
    }

    public function store(Request $request)
    {
        // to check that employee can't request of leaves that alreday exist

        if (Leave::LatestLeaveDates()->first())
        {
            $dates = json_decode(Leave::LatestLeaveDates()->first()->leave_dates);
            $dateRange = CarbonPeriod::create($dates->start_date, $dates->end_date);

            $dateRange = collect($dateRange)
                ->map(function($date) {
                    return $date->format('Y-m-d');
                })->toArray();
        }
        else
        {
            $dateRange = null;
        }

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

        return to_route('employees.index')->with('success', 'Leave sent To Admin');
    }
}
