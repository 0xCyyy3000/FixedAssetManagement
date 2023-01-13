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
            'type' => 'required|in:Machine,Plant,Tangible',
            'serial_number' => 'required',
            'classification' => 'required|in:Functional,Non-Functional',
            'lifespan' => 'required',
            'department' => 'required',
            'year' => 'required',
            'title' => 'required',
            'depreciation' => 'required',
            'description' => 'required',
            'condition' => 'required',
            'notes' => 'required',
        ]);
        ItemProfile::create($items);
        return redirect('/dashboard');
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

    public function listEdit(Request $request)
    {
        // Retrieve the most recent transaction from the database
       $request->validate([
            'purchase_date' => 'required|date',
            'purchase_price' => 'required',
            'inventory_number' => 'required',
            'type' => 'required|in:Machine,Plant,Tangible',
            'serial_number' => 'required',
            'classification' => 'required|in:Functional,Non-Functional',
            'lifespan' => 'required',
            'department' => 'required',
            'year' => 'required',
            'title' => 'required',
            'depreciation' => 'required',
            'description' => 'required',
            'condition' => 'required',
            'notes' => 'required',
        ]);

        $item = ItemProfile::where('transaction_number', $request->transaction_number)->update([
            'purchase_date' => $request->input('purchase_date'),
            'purchase_price' => $request->input('purchase_price'),
            'inventory_number' => $request->input('inventory_number'),
            'type' => $request->input('type'),
            'salvage_value' => $request->input('salvage_value'),
            'classification' => $request->input('classification'),
            'lifespan' => $request->input('lifespan'),
            'department' => $request->input('department'),
            'quantity' => $request->input('quantity'),
            'annual_operating_cost' => $request->input('annual_operating_cost'),
            'body' => $request->input('body'),
            'comments' => $request->input('comments'),
            'notes' => $request->input('notes'),
            'title' => $request->input('title'),
            'replacement_value' => $request->input('replacement_value'),
            'trade_in_value' => $request->input('trade_in_value'),
            'present_value' => $request->input('present_value')

        ]);


        return redirect('/item-list');

    }

    public function select(Request $request)
    {
        $item = ItemProfile::where('transaction_number', $request->id)->first();
        return response()->json($item);
    }
}
