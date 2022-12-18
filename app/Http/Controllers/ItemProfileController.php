<?php

namespace App\Http\Controllers;

use PhpOption\Option;
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
            'lifespan'=>'required',
            'classifications'=>'required',
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
        $option = $request->input('option');
        ItemProfile::create($items, $option );
        return redirect('/home');
    }

    public function create(){
        $options = ['machine', 'equipment'];
        return view('listing.item-profile', compact('options'));

    }
    public function view(){
        $data=ItemProfile::all();
        return view('listing.item-list', ['items' =>$data]);

    }

}
