<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\Models\ItemProfile;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PurchaseRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PurchaseReqItems;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PurchaseRequestController extends Controller
{
    //
    public function index()
    {
        $requests = PurchaseRequest::latest()->paginate(10);
        return view('requests.purchase.index', ['requests' => $requests]);
    }

    public function create()
    {
        $items = ItemProfile::get(['id', 'title']);
        return view('requests.purchase.create', ['items' => $items]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $newTransaction = Transaction::create(['content' => 'New Purchase Request submitted by ' . Auth::user()->name]);
        $newRequest = PurchaseRequest::create([
            'transaction_no' => $newTransaction->id,
            'office_section' => $request->section,
            'fund_cluster' => $request->fund_cluster,
            'amount' => $request->amount,
            'status' => 'Pending',
            'requester' => Auth::user()->id
        ]);

        if ($newRequest) {
            DB::table('requests_purposes')->insert([
                'reference_no' => $newRequest->id,
                'purpose' => $request->note,
                'type' => 1
            ]);
            foreach ($request->items as $item) {
                PurchaseReqItems::create([
                    'purchase_req_id' => $newRequest->id,
                    'item' => $item['item'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'total' => $item['total']
                ]);
            }
            return response()->json(['status' => 200]);
        }
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        PurchaseReqItems::where('purchase_req_id', $request->reference)->delete();
        PurchaseRequest::where('id', $request->reference)->delete();
        return back()->with('alert', 'Request has been deleted!');
    }

    public function select(Request $request)
    {

        $purchaseRequest = PurchaseRequest::find($request->id);
        $note = DB::table('requests_purposes')->where('reference_no', $request->id)->where('type', 1)->first('purpose');
        $serials = PurchaseReqItems::where('purchase_req_id', $request->id)->get();

        return view('requests.purchase.select', ['request' => $purchaseRequest, 'serials' => $serials, 'purpose' => $note->purpose]);
        // $purchaseRequest = PurchaseRequest::find($request->id);
        // $serials = PurchaseReqItems::join('serial_numbers', 'serial_numbers.serial_no', '=', 'items.serial_no')
        //     ->join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
        //     ->where('items.reference_no', $request->id)
        //     ->get(['items.*', 'serial_numbers.*', 'serial_numbers.id as serial_number_id', 'item_profiles.title']);

        // return view('requests.purchase.select', ['request' => $purchaseRequest, 'serials' => $serials]);
    }

    public function update(Request $request)
    {
        $updated = PurchaseRequest::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        if ($updated) {
            return back()->with('alert', 'Request has been updated!');
        } else
            return back()->with('alert', 'There was an error, try again.');
    }

    // public function update(Request $request)
    // {
    //     $updated = PurchaseRequest::where('id', $request->id)->update([
    //         'status' => $request->status
    //     ]);

    //     dd($updated);
    //     if ($updated) {
    //         return back()->with('alert', 'Request has been updated!');
    //     } else
    //         return back()->with('alert', 'There was an error, try again.');
    // }
    public function viewPdf(Request $request)
    {
        $purchaseRequest = PurchaseRequest::find($request->id);
        $serials = PurchaseReqItems::where('purchase_req_id', $request->id)->get();
        // $pdf = Pdf::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
        return view('requests.purchase.requests', ['request' => $purchaseRequest, 'serials' => $serials]);
    }

    public function download(Request $request)
    {

        $purchaseRequest = PurchaseRequest::find($request->id);
        $serials = PurchaseReqItems::where('purchase_req_id', $request->id)->get();


        $data = ['request' => $purchaseRequest, 'serials' => $serials];
        $pdf = Pdf::loadView('requests.purchase.requests', $data);
        return $pdf->download(' request.pdf');
    }
}
