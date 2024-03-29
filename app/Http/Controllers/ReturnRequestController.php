<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\Models\ItemProfile;
use App\Models\ItemsReturn;
use App\Models\Transaction;
use App\Models\SerialNumber;
use Illuminate\Http\Request;
use App\Models\RepairRequest;
use App\Models\ReturnRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
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
        $items = ItemProfile::get(['id', 'title']);
        return view('requests.return.create', ['items' => $items]);
    }

    public function store(Request $request)
    {
        $newRequest = ReturnRequest::create([
            'transaction_no' => 'none',
            'office_section' => $request->section,
            'fund_cluster' => $request->fund_cluster,
            'amount' => $request->amount,
            'status' => 'Pending',
            'requester' => Auth::user()->id
        ]);

        if ($newRequest) {
            $newTransaction = Transaction::create([
                'content' => 'New Return Request submitted by ' . Auth::user()->name,
                'type' => 4, 'reference' => $newRequest->id
            ]);

            ReturnRequest::where('id', $newRequest->id)->update(['transaction_no' => $newTransaction->id]);

            DB::table('requests_purposes')->insert([
                'reference_no' => $newRequest->id,
                'purpose' => $request->note,
                'type' => 4
            ]);
            foreach ($request->items as $item) {
                ItemsReturn::create([
                    'reference_no' => $newRequest->id,
                    'serial_no' => $item['serial_no'],
                    'description' => $item['description'],
                    'cost' => $item['cost'],
                    'remarks' => $item['remarks']
                ]);

                SerialNumber::where('serial_no', $item['serial_no'])->update(['status' => 1]);
            }
            return response()->json(['status' => 200]);
        }
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        ItemsReturn::where('reference_no', $request->reference)->delete();
        ReturnRequest::where('id', $request->reference)->delete();
        return back()->with('alert', 'Request has been deleted!');
    }

    public function select(Request $request)
    {
        $returnRequest = ReturnRequest::find($request->id);
        $note = DB::table('requests_purposes')->where('reference_no', $request->id)->where('type', 4)->first('purpose');
        $serials = ItemsReturn::join('serial_numbers', 'serial_numbers.serial_no', '=', 'items_returns.serial_no')
            ->join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('items_returns.reference_no', $request->id)
            ->get(['items_returns.*', 'serial_numbers.*', 'serial_numbers.id as serial_number_id', 'item_profiles.title']);

        return view('requests.return.select', ['request' => $returnRequest, 'serials' => $serials, 'purpose' => $note->purpose]);
    }

    public function update(Request $request)
    {
        // dd($request->all());

        $updated = ReturnRequest::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        Transaction::create(['content' => 'A return request has been updated #' . $request->id, 'type' => 4, 'reference' => $request->id]);
        if ($updated) {
            return back()->with('alert', 'Request has been updated!');
        } else
            return back()->with('alert', 'There was an error, try again.');
    }

    public function viewPdf(Request $request)
    {
        $returnRequest = ReturnRequest::find($request->id);
        $serials = ItemsReturn::join('serial_numbers', 'serial_numbers.serial_no', '=', 'items_returns.serial_no')
            ->join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('items_returns.reference_no', $request->id)
            ->get(['items_returns.*', 'serial_numbers.*', 'serial_numbers.id as serial_number_id', 'item_profiles.title']);

        // $pdf = Pdf::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
        return view('requests.return.requests', ['request' => $returnRequest, 'serials' => $serials]);
    }

    public function download(Request $request)
    {
        $returnRequest = ReturnRequest::find($request->id);
        $serials = ItemsReturn::join('serial_numbers', 'serial_numbers.serial_no', '=', 'items_returns.serial_no')
            ->join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('items_returns.reference_no', $request->id)
            ->get(['items_returns.*', 'serial_numbers.*', 'serial_numbers.id as serial_number_id', 'item_profiles.title']);

        $data = ['request' => $returnRequest, 'serials' => $serials];
        $pdf = Pdf::loadView('requests.return.requests', $data);
        return $pdf->download('return request.pdf');
    }
}
