<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class employeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employee',['employees'=>$employees]);
    }
}
