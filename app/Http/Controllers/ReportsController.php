<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\items;
use App\Models\ItemMedia;
use App\Models\ItemProfile;
use App\Models\SerialNumber;
use Illuminate\Http\Request;
use App\Models\ReturnRequest;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\ServerBag;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportsController extends Controller
{
    //
    public function index(){
        $data=ItemProfile::join('serial_numbers','serial_numbers.reference_no', '=', 'item_profiles.id')
        ->get(['item_profiles.inventory_number','item_profiles.title','item_profiles.description','item_profiles.classification','item_profiles.purchase_date','item_profiles.purchase_price','serial_numbers.serial_no','serial_numbers.condition','serial_numbers.color','serial_numbers.lifespan','serial_numbers.location',]);

        return view('reports.buttons', compact('data'));
    }
    public function download()
    {

        // $item = ItemProfile::all();
        // $serials = SerialNumber::where();
        $item=ItemProfile::join('serial_numbers','serial_numbers.reference_no', '=', 'item_profiles.id')
            ->get(['item_profiles.inventory_number','item_profiles.title','item_profiles.description','item_profiles.classification','item_profiles.purchase_date','item_profiles.purchase_price','serial_numbers.serial_no','serial_numbers.condition','serial_numbers.color','serial_numbers.lifespan','serial_numbers.location',]);

        $data=['data' => $item];
            $pdf = Pdf::loadView('reports.asset', $data);
            return $pdf->download('return request.pdf');
        // return view('reports.asset', compact('item'));
    }

    public function view()
    {

        // $item = ItemProfile::all();
        // $serials = SerialNumber::where();
        $data=ItemProfile::join('serial_numbers','serial_numbers.reference_no', '=', 'item_profiles.id')
            ->get(['item_profiles.inventory_number','item_profiles.title','item_profiles.description','item_profiles.classification','item_profiles.purchase_date','item_profiles.purchase_price','serial_numbers.serial_no','serial_numbers.condition','serial_numbers.color','serial_numbers.lifespan','serial_numbers.location',]);

        return view('reports.asset', compact('data'));
    }

}