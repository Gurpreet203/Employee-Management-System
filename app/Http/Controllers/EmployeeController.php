<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index', [
            'leaves' => Leave::where('user_id', Auth::id())
                ->latest()
                ->get()
        ]);
    }
}
