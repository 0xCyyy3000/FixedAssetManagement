<?php

namespace App\Http\Controllers;

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
        // Checking if existing
        if ($employee) {
            Session::flash('badge_number', $employee->badge_number);
            return redirect()->route('register');
        } else {
            return back()->with('status', 'Sorry, badge number not found.');
        }
    }
}
