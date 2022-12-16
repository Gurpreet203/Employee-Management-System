<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index', [
            'leaves' => Leave::visibleTo()
                ->latest()
                ->get()
        ]);
    }

    public function penality()
    {
        return view('employee.penality', [
            'penalities' => Attendance::Absent()->get()
        ]);
    }
}
