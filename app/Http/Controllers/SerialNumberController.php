<?php

namespace App\Http\Controllers;

use App\Models\ItemsRepair;
use App\Models\ItemsReturn;
use App\Models\ItemsReplace;
use App\Models\SerialNumber;
use Illuminate\Http\Request;

class SerialNumberController extends Controller
{
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'reference_no' => 'required',
            'serial_no' => ['required', 'unique:serial_numbers'],
            'condition' => 'required',
            'color' => 'required',
            'price' => 'required',
            'location' => 'required',
            'lifespan' => ['required', 'numeric', 'min:1']
        ]);

        $created = SerialNumber::create($formFields);
        if ($created) {
            return back()->with('alert', 'Serial has been added!');
        } else return back()->with('alert', 'Serial has not been added due error, please try again.');
    }

    public function update(Request $request)
    {
        $request->validate(['id' => 'required']);

        // Validating if the Serial number is unique when it has new value
        $currentSerial = SerialNumber::find($request->id);
        if (!$request->serial_no == $currentSerial->serial_no) {
            $request->validate(['serial_no' => 'unique:serial_numbers']);
        }

        $formFields = $request->validate([
            'reference_no' => 'required',
            'serial_no' => 'required',
            'condition' => 'required',
            'color' => 'required',
            'price' => 'required',
            'location' => 'required',
            'lifespan' => ['required', 'numeric', 'min:1']
        ]);

        $updated = SerialNumber::where('id', $request->id)->update($formFields);
        if ($updated) {
            return back()->with('alert', 'Changes has been saved!');
        } else return back()->with('alert', 'There was an error saving, please try again.');
    }

    public function destroy(Request $request)
    {
        $deleted = SerialNumber::where('id', $request->id)->delete();
        if ($deleted) {
            return back()->with('alert', 'Serial has been removed!');
        }
        return back()->with('alert', 'There was an error removing, try again.');
    }

    public function select(Request $request)
    {
        $serial = SerialNumber::find($request->id);
        return response()->json($serial);
    }

    public function indexSub(Request $request)
    {
       
        $serials = SerialNumber::where('reference_no', $request->reference_no)
        ->whereNotIn('serial_no',ItemsRepair::pluck('serial_no'))
        ->whereNotIn('serial_no',ItemsReturn::pluck('serial_no'))
        ->whereNotIn('serial_no',ItemsReplace::pluck('serial_no'))
        ->get(['id', 'serial_no']);
    
    return response()->json(['serials' => $serials]);
        
        // $serials = SerialNumber::where('reference_no', $request->reference_no)->get(['id', 'serial_no']);
        // return response()->json(['serials' => $serials]);
    }

    public function serial(Request $request)
    {
        $serial_no = $request->get('serial_no');
        $repair_exists = ItemsRepair::where('serial_no', $serial_no)->exists();
        $return_exist = ItemsReturn::where('serial_no', $serial_no)->exists();
        $replace_exist = ItemsReplace::where('serial_no', $serial_no)->exists();
        $exist= [ $repair_exists,$return_exist,$replace_exist];
        return response()->json(['exists' => $exist]);
    }
}
