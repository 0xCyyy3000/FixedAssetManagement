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
        return redirect('/ProfileItem/page2');
    }

    public function create(){
        return view('listing.item-profile');

    }
    public function view(){
        $data=ItemProfile::all();
        return view('listing.item-list', ['items' =>$data]);

    }

    public function nextview(){
        // Retrieve the most recent transaction from the database
        $transaction = ItemProfile::latest()->first();
        $transaction->purchase_number= 'Update purchase_number';
        return view('listing.item-profile-next', compact('transaction'));
        // $lastRecord = ItemProfile::latest()->first();
        // return view('listing.item-profile-next', ['items' =>$lastRecord]); 
    }

    public function lastview(){
        // Retrieve the most recent transaction from the database
        $transaction = ItemProfile::latest()->first();

        // Update the post
        return redirect('listing.item-profile-last', compact('transaction'));
    }

    // public function updatenxt(){

    //     $task = ItemProfile::getTable('item_profiles')->latest()->first();
    //     $task->transaction_number = 'Updated transaction_number';
    //     $task->purchase_date = 'Updated purchase_date';
    //     $task->type = 'Updated type';
    //     $task->classification = 'Updated classification';
    //     $task->quantity = 'Updated quantity';
    //     $task->replacement_value = 'Updated replacement_value';
    //     $task->trade_in_value = 'Updated trade_in_value';
    //     $task->present_value = 'Updated present_value';
    //     $task->purchase_price = 'Updated purchase_price';
    //     $task->save();

    //     return redirect('listing.item-profile-last');

    // }
    

}