<?php

namespace App\Http\Controllers;

use App\Models\ListItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingItem extends Controller
{
    //
    public function create(){
        return view('listing.item-profile');
    }
    public function store(Request $request){
        // $data=$request->validate([
        //     'purchase_date' => 'required',
        //     'purchase_price' => 'required',
        //     'inventory_number'=> 'required',
        //     'serial_number' => ['required',Rule::unique('item_profile')],
        //     'type' => 'required',
        //     'salvage_value' => 'required',
        //     'classification' => 'required',
        //     'lifespan' => 'required',
        //     'department' => 'required',
        //     'quantity' => 'required',
        //     'annual_operating_cost' => 'required',
        //     'year' =>'required',
        //     'replacement_value' => 'required',
        //     'title' => 'required',
        //     'trade_in_value' =>'required',
        //     'body' => 'required',
        //     'present_value' => 'required',
        //     'comments' => 'required',
        //     'notes' => 'required'
        // ]);

        ListItem::create([
            'purchase_date' => $request->purchase_date
        ]);

        // $fill = ListItem::create($data);
        
        

        return redirect('/home');
    }   
}
