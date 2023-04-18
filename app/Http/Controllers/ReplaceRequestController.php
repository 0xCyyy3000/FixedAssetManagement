<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\Models\ItemProfile;
use App\Models\Transaction;
use App\Models\ItemsReplace;
use App\Models\SerialNumber;
use Illuminate\Http\Request;
use App\Models\ReplaceRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
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
        $newRequest = ReplaceRequest::create([
            'transaction_no' => 'none',
            'office_section' => $request->section,
            'fund_cluster' => $request->fund_cluster,
            'amount' => $request->amount,
            'status' => 'Pending',
            'requester' => Auth::user()->id
        ]);

        if ($newRequest) {
            $newTransaction = Transaction::create([
                'content' => 'New Replace Request submitted by ' . Auth::user()->name,
                'type' => 3,
                'reference' => $newRequest->id
            ]);
            ReplaceRequest::where('id', $newRequest->id)->update(['transaction_no' => $newTransaction->id]);

           
            foreach ($request->items as $item) {
                ItemsReplace::create([
                    'reference_no' => $newRequest->id,
                    'serial_no' => $item['serial_no'],
                    'cost' => $item['cost'],
                    'remarks' => $item['remarks']
                ]);
                DB::table('requests_purposes')->insert([
                    'reference_no' => $newRequest->id,
                    'purpose' => $item['remarks'],
                    'type' => 3
                ]);

                SerialNumber::where('serial_no', $item['serial_no'])->update(['status' => 1]);
            }
            return response()->json(['status' => 200]);
        }
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        ItemsReplace::where('reference_no', $request->reference)->delete();
        ReplaceRequest::where('id', $request->reference)->delete();
        return back()->with('alert', 'Request has been deleted!');
    }

    public function select(Request $request)
    {
        $replaceRequest = ReplaceRequest::find($request->id);
        $note = DB::table('requests_purposes')->where('reference_no', $request->id)->where('type', 3)->first('purpose');
        $serials = ItemsReplace::join('serial_numbers', 'serial_numbers.serial_no', '=', 'items_replaces.serial_no')
            ->join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('items_replaces.reference_no', $request->id)
            ->get(['items_replaces.*', 'serial_numbers.*', 'serial_numbers.id as serial_number_id', 'item_profiles.title']);

        return view('requests.replace.select', ['request' => $replaceRequest, 'serials' => $serials, 'purpose' => $note->purpose]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        Transaction::create(['content' => 'A replace request has been updated #' . $request->id, 'type' => 3, 'reference' => $request->id]);
        $updated = ReplaceRequest::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        if ($updated) {
            return back()->with('alert', 'Request has been updated!');
        } else
            return back()->with('alert', 'There was an error, try again.');
    }

    public function viewPdf(Request $request)
    {
        $replaceRequest = ReplaceRequest::find($request->id);
        $serials = ItemsReplace::join('serial_numbers', 'serial_numbers.serial_no', '=', 'items_replaces.serial_no')
            ->join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('items_replaces.reference_no', $request->id)
            ->get(['items_replaces.*', 'serial_numbers.*', 'serial_numbers.id as serial_number_id', 'item_profiles.title']);

        // $pdf = Pdf::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
        return view('requests.replace.requests', ['request' => $replaceRequest, 'serials' => $serials]);
    }

    public function download(Request $request)
    {
        $replaceRequest = ReplaceRequest::find($request->id);
        $serials = ItemsReplace::join('serial_numbers', 'serial_numbers.serial_no', '=', 'items_replaces.serial_no')
            ->join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('items_replaces.reference_no', $request->id)
            ->get(['items_replaces.*', 'serial_numbers.*', 'serial_numbers.id as serial_number_id', 'item_profiles.title']);


        $data = ['request' => $replaceRequest, 'serials' => $serials];
        $pdf = Pdf::loadView('requests.replace.requests', $data);
        return $pdf->download(' request.pdf');
    }
}
