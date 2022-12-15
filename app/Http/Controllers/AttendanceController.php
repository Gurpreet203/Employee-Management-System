<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use App\Notifications\LeaveApprovedNotification;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AttendanceController extends Controller
{
    public function store()
    {
        $now = now()->toDateString();
        $previousDate = Attendance::latestDate()
            ->first()->date;
        $previous = Carbon::parse($previousDate);
        $latest = Carbon::parse($now);

        $days = $previous->diffInDays($latest);

        if (Attendance::exist()->first())
        {
            return back()->with('error', 'You Already Marked Your Attendance');
        }
        elseif (Attendance::leaves()->first())
        {
            return back()->with('error', 'You Filled The Leave For Today');
        }
        elseif ($days > 1)
        {
            $dateRange = CarbonPeriod::create($previousDate, Carbon::yesterday());

            collect($dateRange)
            ->map(function($date) {
                return $date->format('Y-m-d');
            })
            ->each(function($date) {

                Attendance::create([
                    'user_id' => Auth::id(),
                    'date' => $date,
                    'status' => 'Absent'
                ]);
            });
        }

        Attendance::create([
            'user_id' => Auth::id(),
            'date' => $now,
            'status' => 'Present'
        ]);

        return back()->with('success', 'Attendance Complete');
    }

    public function leave(Leave $leave)
    {
        $dates = json_decode($leave->leave_dates);
        $dateRange = CarbonPeriod::create($dates->start_date, $dates->end_date);

        collect($dateRange)
            ->map(function($date) {
                return $date->format('Y-m-d');
            })
            ->each(function($date) use($leave){

                Attendance::create([
                    'user_id' => $leave->user_id,
                    'date' => $date,
                    'status' => 'Leave'
                ]);
            });
        
        Notification::send(User::find($leave->user_id), new LeaveApprovedNotification(Auth::user()));

        return to_route('leaves')->with('success', 'Successfully Approved');
    }
}
