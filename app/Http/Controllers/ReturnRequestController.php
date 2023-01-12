<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ReturnRequest;
use Illuminate\Support\Facades\Auth;

class ReturnRequestController extends Controller
{
    //
    public function index()
    {
        $requests = ReturnRequest::latest()->paginate(10);
        return view('requests.return.index', ['requests' => $requests]);
    }

    public function create()
    {
        return view('requests.return.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $newTransaction = Transaction::create(['content' => 'New Return Request submitted by ' . Auth::user()->name]);
        $newRequest = ReturnRequest::create([
            'transaction_no' => $newTransaction->id,
            'office_section' => $request->section,
            'amount' => $request->amount,
            'status' => $request->status
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

            // return redirect()->route('replace.request');
            return response()->json(['status' => 200]);
        }
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        items::where('reference_no', $request->reference)->delete();
        ReturnRequest::where('id', $request->reference)->delete();
        return back();
    }
}
