<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\Models\ItemProfile;
use App\Models\ItemsRepair;
use App\Models\Transaction;

use App\Models\SerialNumber;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;
use App\Models\RepairRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
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
        $newTransaction = Transaction::create(['content' => 'New Repair Request submitted by ' . Auth::user()->name,'type'=>2,'reference'=>$request->id]);
        $newRequest = RepairRequest::create([
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
                'type' => 2
            ]);
            foreach ($request->items as $item) {
                ItemsRepair::create([
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
        ItemsRepair::where('reference_no', $request->reference)->delete();
        RepairRequest::where('id', $request->reference)->delete();
        return back()->with('alert', 'Request has been deleted!');
    }

    public function select(Request $request)
    {
        $repairRequest = RepairRequest::find($request->id);
        $note = DB::table('requests_purposes')->where('reference_no', $request->id)->where('type', 2)->first('purpose');
        $serials = ItemsRepair::join('serial_numbers', 'serial_numbers.serial_no', '=', 'items_repairs.serial_no')
            ->join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('items_repairs.reference_no', $request->id)
            ->get(['items_repairs.*', 'serial_numbers.*', 'serial_numbers.id as serial_number_id', 'item_profiles.title']);

        return view('requests.repair.select', ['request' => $repairRequest, 'serials' => $serials, 'purpose' => $note->purpose]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        Transaction::create(['content' => 'A return request has been updated #'. $request->id, 'type'=>2,'reference'=>$request->id]);
        $updated = RepairRequest    ::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        
        if ($updated) {
            return back()->with('alert', 'Request has been updated!');
        } else
            return back()->with('alert', 'There was an error, try again.');
    }
    public function viewPdf(Request $request)
    {
        $repairRequest = RepairRequest::find($request->id);
        $serials = ItemsRepair::join('serial_numbers', 'serial_numbers.serial_no', '=', 'items_repairs.serial_no')
            ->join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('items_repairs.reference_no', $request->id)
            ->get(['items_repairs.*', 'serial_numbers.*', 'serial_numbers.id as serial_number_id', 'item_profiles.title']);

        // $pdf = Pdf::loadView('pdf.invoice', $data);
        // return $pdf->download('invoice.pdf');
        return view('requests.repair.requests', ['request' => $repairRequest, 'serials' => $serials]);
    }

    public function download(Request $request)
    {
        $repairRequest = RepairRequest::find($request->id);
        $serials = ItemsRepair::join('serial_numbers', 'serial_numbers.serial_no', '=', 'items_repairs.serial_no')
            ->join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('items_repairs.reference_no', $request->id)
            ->get(['items_repairs.*', 'serial_numbers.*', 'serial_numbers.id as serial_number_id', 'item_profiles.title']);


        $data = ['request' => $repairRequest, 'serials' => $serials];
        $pdf = Pdf::loadView('requests.repair.requests', $data);
        return $pdf->download(' request.pdf');
    }
}
