<?php

namespace App\Http\Controllers;

use App\Models\ItemProfile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemProfileController extends Controller
{

    
    public function store(Request $request)
    {
        $items = $request->validate([
            'purchase_date'=>'required',
            'purchase_price'=>'required',
            'inventory_number'=>'required',
            'type'=>'required',
            'salvage_value'=>'required',
            'serial_number'=>'required',
            'classification'=>'required',
            'lifespan'=>'required',
            'department'=>'required',
            'quantity'=>'required',
            'annual_operating_cost'=>'required',
            'year'=>'required',
            'replacement_value'=>'required',
            'title'=>'required',
            'trade_in_value'=>'required',
            'body'=>'required',
            'present_value'=>'required',
            'comments'=>'required',
            'notes'=>'required',
        ]);
        
        ItemProfile::create($items);
        return redirect('/home');
    }

    public function create(){
        return view('listing.item-profile');

    }
    public function view(){
        $data=ItemProfile::all();
        return view('listing.item-list', ['items' =>$data]);

    }

}
