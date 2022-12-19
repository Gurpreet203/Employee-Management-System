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

    public function show(User $user)
    {
        return view('users.record', [
            'attendences' => Attendance::AttendenceRecord($user)
            ->search(request(['search', 'sort']))
            ->get(),
            'user' => $user
        ]);
    }

    public function store()
    {
        $now = now()->toDateString();
        $time = now()->toTimeString();

        if ($time >= "20:30:00" && $time <= "9:25:00")
        {
            return back()->with('error', 'This is not the office timmings');
        }

        //  find the days gap between present and last present or leave to mark absent

        if (Attendance::latestDate(Auth::user())->first())
        {
            $previousDate = Attendance::latestDate(Auth::user())
            ->first()->date;
            $previous = Carbon::parse($previousDate);
            $latest = Carbon::parse($now);

            $days = $previous->diffInDays($latest);
        }
        else
        {
            $days = 0;
        }

    // If already attendance done then it works , Also last elsif for mark absent

        if (Attendance::leaves()->first())
        {
            return back()->with('error', 'You Filled The Leave For Today');
        }
        elseif (Attendance::exist()->first())
        {
            return back()->with('error', 'You Already Marked Your Attendance');
        }
        
        elseif ($days > 1)
        {
            $dateRange = CarbonPeriod::create($previousDate, Carbon::yesterday());

            collect($dateRange)
            ->map(function($date) {
                return $date->format('Y-m-d');
            })
            ->skip(1)
            ->each(function($date) {

                Attendance::create([
                    'user_id' => Auth::id(),
                    'date' => $date,
                    'status' => Attendance::ABSENT,
                    'penality' => 10
                ]);
            });
        }

        Attendance::create([
            'user_id' => Auth::id(),
            'date' => $now,
            'status' => Attendance::PRESENT
        ]);

        return back()->with('success', 'Attendance Complete');
    }

// leave function for enter leaves in attendance table

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
                    'status' => Attendance::LEAVE
                ]);
            });
        $user = User::find($leave->user_id);
        Notification::send($user, new LeaveApprovedNotification(Auth::user()));

        return to_route('leaves')->with('success', 'Successfully Approved');
    }
}
