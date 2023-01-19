<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ReplaceRequest;
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
        return view('requests.replace.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $newTransaction = Transaction::create(['content' => 'New Replace Request submitted by ' . Auth::user()->name]);
        $newRequest = ReplaceRequest::create([
            'transaction_no' => $newTransaction->id,
            'office_section' => $request->section,
            'amount' => $request->amount,
            'status' => $request->status,
            'requester' => Auth::user()->id
        ]);

        if ($newRequest) {
            foreach ($request->items as $item) {
                items::create([
                    'reference_no' => $newRequest->id,
                    'serial_no' => $item['serial_no'],
                    'item' => $item['item'],
                    'description' => $item['description'],
                    'qty' => $item['quantity'],
                    'unit' => $item['unit'],
                    'price' => $item['price'],
                    'total' => $item['total'],
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
        return back();
    }
}
