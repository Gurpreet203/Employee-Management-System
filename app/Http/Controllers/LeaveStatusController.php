<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use App\Notifications\LeaveRejectedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class LeaveStatusController extends Controller
{
    public function __invoke(Request $request, Leave $leave)
    {
        if ($request['status'] == 'Rejected')
        {
            $leave->update([
                'status' => 'Rejected'
            ]);
            Notification::send(User::find($leave->user_id), new LeaveRejectedNotification(Auth::user()));

            return back()->with('success', 'Successfully Rejected');
        }
        elseif ($request['status'] == 'Approved')
        {
            $leave->update([
                'status' => 'Approved'
            ]);

            $attendance = new AttendanceController();
            $attendance->leave($leave);
        }
            
        return back()->with('error', 'Status Is Not Valid');
        
    }
}
