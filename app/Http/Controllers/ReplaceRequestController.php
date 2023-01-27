<?php

namespace App\Http\Controllers;

use App\Models\ItemProfile;
use App\Models\items;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ReplaceRequest;
use App\Models\SerialNumber;
use Illuminate\Support\Facades\Auth;

class ReplaceRequestController extends Controller
{
    public function index()
    {
        $requests = ReplaceRequest::latest()->paginate(10);
        return view('requests.replace.index', ['requests' => $requests]);
    }

    public function create()
    {
        $items = ItemProfile::get(['id', 'title']);
        return view('requests.replace.create', ['items' => $items]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $newTransaction = Transaction::create(['content' => 'New Replace Request submitted by ' . Auth::user()->name]);
        $newRequest = ReplaceRequest::create([
            'transaction_no' => $newTransaction->id,
            'office_section' => $request->section,
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
        ReplaceRequest::where('id', $request->reference)->delete();
        return back()->with('alert', 'Request has been deleted!');
    }

    public function select(Request $request)
    {
        $replaceRequest = ReplaceRequest::find($request->id);
        $serials = items::join('serial_numbers', 'serial_numbers.serial_no', '=', 'items.serial_no')
            ->join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('items.reference_no', $request->id)
            ->get(['items.*', 'serial_numbers.*', 'serial_numbers.id as serial_number_id', 'item_profiles.title']);

        return view('requests.replace.select', ['request' => $replaceRequest, 'serials' => $serials]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $updated = ReplaceRequest::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        if ($updated) {
            return back()->with('alert', 'Request has been updated!');
        } else
            return back()->with('alert', 'There was an error, try again.');
    }
}
