<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{

    public function badgeadd(Request $request)
    {
        // dd($request->all());
        $formFields = $request->validate([
            'badge_number' => 'required',
            'full_name' => 'required'

        ]);

        Employee::create($formFields);

        return back()->with('alert', 'Badge added');
    }


    public function create()
    {
        return view('auth.certify');
    }

    public function certify(Request $request)
    {
        $request->validate([
            'badge_number' => ['required', 'min:5']
        ]);

        // Retreiving badge_number in Employees table
        $employee = Employee::where('badge_number', $request->badge_number)->first();
        // Retreiving registered badge_number
        $registered = User::where('badge_number', $employee->badge_number)->first();

        // Checking if badge_number is existing and not registered
        if ($employee and !$registered) {
            Session::flash('badge_number', $employee->badge_number);
            Session::flash('full_name', $employee->full_name);
            return redirect()->route('register');
        } else if ($registered) {
            return back()->with('status', 'Sorry, badge number has already been registered.');
        } else {
            return back()->with('status', 'Sorry, badge number not found.');
        }
    }
}
