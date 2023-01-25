<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\Models\ItemProfile;
use App\Models\Transaction;

use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use App\Models\RepairRequest;
use Illuminate\Support\Facades\Auth;

class RepairRequestController extends Controller
{
    //
    public function index()
    {
        $requests = RepairRequest::latest()->paginate(10);
        return view('requests.repair.index', ['requests' => $requests]);
    }

    public function create()
    {
        $items = ItemProfile::get(['id', 'title']);
        return view('requests.repair.create', ['items' => $items]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $newTransaction = Transaction::create(['content' => 'New Repair Request submitted by ' . Auth::user()->name]);
        $newRequest = RepairRequest::create([
            'transaction_no' => $newTransaction->id,
            'office_section' => $request->section,
            'fund_cluster' => $request->fund_cluster,
            'amount' => $request->amount,
            'status' => 'Pending',
            'requester' => Auth::user()->id
        ]);

        if ($newRequest) {
            foreach ($request->items as $item) {
                items::create([
                    'reference_no' => $newRequest->id,
                    'serial_no' => $item['serial_no'],
                    'description' => $item['description'],
                    'cost' => $item['cost'],
                    'remarks' => $item['remarks']
                ]);
            }
            return response()->json(['status' => 200]);
        }
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        items::where('reference_no', $request->reference)->delete();
        RepairRequest::where('id', $request->reference)->delete();
        return back()->with('alert', 'Request has been deleted!');
    }

    public function select(Request $request)
    {
        $repairRequest = RepairRequest::find($request->id);
        $serials = items::join('serial_numbers', 'serial_numbers.serial_no', '=', 'items.serial_no')
            ->join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('items.reference_no', $request->id)
            ->get(['items.*', 'serial_numbers.*', 'serial_numbers.id as serial_number_id', 'item_profiles.title']);

        return view('requests.repair.select', ['request' => $repairRequest, 'serials' => $serials]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $updated = RepairRequest    ::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        if ($updated) {
            return back()->with('alert', 'Request has been updated!');
        } else
            return back()->with('alert', 'There was an error, try again.');
    }
}
