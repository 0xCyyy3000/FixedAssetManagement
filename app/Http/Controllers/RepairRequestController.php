<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class RepairRequestController extends Controller
{
    //
    public function view()
    {
        $data = RepairRequest::all();
        return view('listing.repair-request', ['item' => $data]);
    }

    public function create(Request $request)
    {

        $items = $request->validate([
            'entity' => 'required',
            'fund_cluster' => 'required',
            'date' => 'required',
            'office_sec' => 'required',
            'transaction_no' => 'required',
            'appendix_no' => 'required',
            'purpose' => 'required',
            'item' => 'required',
            'description' => 'required',
            'qty' => 'required',
            'unit' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);

        dd($items);
    }
}
