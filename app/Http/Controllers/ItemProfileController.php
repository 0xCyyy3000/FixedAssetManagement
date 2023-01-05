<?php

namespace App\Http\Controllers;

use App\Models\ItemProfile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\Console\Input\Input;

class ItemProfileController extends Controller
{


    public function store(Request $request)
    {
        $items = $request->validate([
            'purchase_date' => 'required|date',
            'purchase_price' => 'required',
            'inventory_number' => 'required',
            'type' => 'required|in:Machine,plant,Tangible',
            'salvage_value' => 'required',
            'serial_number' => 'required',
            'classification' => 'required',
            'lifespan' => 'required',
            'department' => 'required',
            'quantity' => 'required',
            'annual_operating_cost' => 'required',
            'year' => 'required',
            'replacement_value' => 'required',
            'title' => 'required',
            'trade_in_value' => 'required',
            'body' => 'required',
            'present_value' => 'required',
            'comments' => 'required',
            'notes' => 'required',
        ]);

        ItemProfile::create($items);
        return redirect('/ProfileItem/page2');
    }

    public function create()
    {
        return view('listing.item-profile');
    }
    public function view()
    {
        $data = ItemProfile::all();
        return view('listing.item-list', ['items' => $data]);
    }

    public function nextview()
    {
        // Retrieve the most recent transaction from the database
        $transaction = ItemProfile::latest()->first();
        return view('listing.item-profile-next', compact('transaction'));
    }

    public function update(Request $request)
    {
        // Retrieve the most recent transaction from the database
        $request->validate([
            'type' => 'required',
            'purchase_date' => 'required',
            'classification' => 'required',
            'purchase_price' => 'required',
            'replacement_value' => 'required',
            'trade_in_value' => 'required',
            'present_value' => 'required',
            'quantity' => 'required'
        ]);
        $itemProfile = ItemProfile::latest()->first();
        ItemProfile::where('transaction_number', $itemProfile->transaction_number)->update([
            'purchase_date' => $request->purchase_date,
            'purchase_price' => $request->purchase_price,
            'type' => $request->type,
            'classification' => $request->classification,
            'replacement_value' => $request->replacement_value,
            'trade_in_value' => $request->trade_in_value,
            'present_value' => $request->present_value,
            'quantity' => $request->quantity,
        ]);

        // Update the post
        // Update the post
        return redirect('/home');
    }

    public function select(Request $request)
    {
        $item = ItemProfile::where('transaction_number', $request->id)->first();
        return response()->json($item);
    }
}
