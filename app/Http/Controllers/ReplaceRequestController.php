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
        dd($request->all());

        $newTransaction = Transaction::create(['content' => 'New Replace Request submitted by ' . Auth::user()->name]);
        $newRequest = ReplaceRequest::create([
            'transaction_no' => $newTransaction->id,
            'office_section' => $request->office_section,
            'amount' => $request->amount,
            'status' => $request->status
        ]);

        if ($newRequest) {
            items::create([
                'reference_no' => $newRequest->id,
                'serial_no' => $request->serial_no,
                'item' => $request->item,
                'description' => $request->description,
                'qty' => $request->quantity,
                'unit' => $request->unit,
                'price' => $request->price,
                'total' => $request->total,
                'remarks' => $request->remarks
            ]);
        }
    }
}
