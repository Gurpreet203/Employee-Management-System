<?php

namespace App\Http\Controllers;

use App\Models\Leave;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index', [
            'leaves' => Leave::latest()->get()
        ]);
    }
}
