<?php

namespace App\Http\Controllers;

use App\Models\items;
use App\Models\RepairRequest;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class RepairRequestController extends Controller
{
    //
    public function view()
    {
        $data = items::latest()->get();
        return view('listing.repair-request', ['item' => $data]);
    }

    public function create(Request $request)
    {

        RepairRequest::create([
            'entity_name' => $request->input('entity_name'),
            'fund_cluster' =>$request->input('fund_cluster'),
            'date' => $request->input('date'),
            'office_sec' => $request->input('office_sec'),
            'transaction_no' => $request->input('transaction_no'),
            'appendix_no' => $request->input('appendix_no'),
            'purpose' => $request->input('purpose'),
        ]);

        return redirect('/RepairRequest')->withInput();
        dd($items);
    }
  
}
