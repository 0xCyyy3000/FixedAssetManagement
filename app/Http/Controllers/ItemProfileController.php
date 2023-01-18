<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ItemProfile;
use App\Models\Transaction;
use App\Models\SerialNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class ItemProfileController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('photos', 'public');
        } else $imagePath = null;

        $newTransaction = Transaction::create(['content' => 'New Item Profile added by ' . Auth::user()->name]);
        $newRequest = ItemProfile::create([
            'transaction_no' => $newTransaction->id,
            'purchase_date' => $request->purchase_date,
            'purchase_price' => $request->purchase_price,
            'inventory_number' => $request->inventory_number,
            'classification' => $request->classification,
            'lifespan' => $request->lifespan,
            'department' => $request->department,
            'year' => $request->year,
            'title' => $request->title,
            'depreciation' => $request->depreciation,
            'description' => $request->description,
            'condition' => $request->condition,
            'image' => $imagePath,
            'notes' => $request->notes,
            'inventoried_by' => Auth::user()->id,
            'supplier' => $request->supplier,
            'warranty' => $request->warranty
        ]);

        if ($newRequest) {
            foreach ($request->serials as $serial) {
                SerialNumber::create([
                    'reference_no' => $newRequest->id,
                    'serial_no' => $serial
                ]);
            }
            return back()->with('alert', 'Item profile added!');
        }
        // $items = $request->validate([
        //     'purchase_date' => 'required|date',
        //     'purchase_price' => 'required',
        //     'inventory_number' => 'required',
        //     'type' => 'required|in:Machine,Plant,Tangible',
        //     'serial_number' => 'required',
        //     'classification' => 'required|in:Functional,Non-Functional',
        //     'lifespan' => 'required',
        //     'department' => 'required',
        //     'year' => 'required',
        //     'title' => 'required',
        //     'depreciation' => 'required',
        //     'description' => 'required',
        //     'condition' => 'required',
        //     'notes' => 'required',
        // ]);
        // ItemProfile::create($items);
        // return redirect('/dashboard');
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

    // public function listEdit(Request $request)
    // {
    //     // Retrieve the most recent transaction from the database
    //    $request->validate([
    //         'purchase_date' => 'required|date',
    //         'purchase_price' => 'required',
    //         'inventory_number' => 'required',
    //         'type' => 'required|in:Machine,Plant,Tangible',
    //         'serial_number' => 'required',
    //         'classification' => 'required|in:Functional,Non-Functional',
    //         'lifespan' => 'required',
    //         'department' => 'required',
    //         'year' => 'required',
    //         'title' => 'required',
    //         'depreciation' => 'required',
    //         'description' => 'required',
    //         'condition' => 'required',
    //         'notes' => 'required',
    //     ]);

    //     $item = ItemProfile::where('transaction_number', $request->transaction_number)->update([
    //         'purchase_date' => $request->input('purchase_date'),
    //         'purchase_price' => $request->input('purchase_price'),
    //         'inventory_number' => $request->input('inventory_number'),
    //         'type' => $request->input('type'),
    //         'salvage_value' => $request->input('salvage_value'),
    //         'classification' => $request->input('classification'),
    //         'lifespan' => $request->input('lifespan'),
    //         'department' => $request->input('department'),
    //         'quantity' => $request->input('quantity'),
    //         'annual_operating_cost' => $request->input('annual_operating_cost'),
    //         'body' => $request->input('body'),
    //         'comments' => $request->input('comments'),
    //         'notes' => $request->input('notes'),
    //         'title' => $request->input('title'),
    //         'replacement_value' => $request->input('replacement_value'),
    //         'trade_in_value' => $request->input('trade_in_value'),
    //         'present_value' => $request->input('present_value')

    //     ]);


    //     return redirect('/item-list');

    // }

    public function select(Request $request)
    {
        $item = ItemProfile::where('id', $request->id)->first();
        $serials = SerialNumber::join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('serial_numbers.reference_no', $request->id)
            ->get(['item_profiles.*', 'serial_numbers.*']);

        $item->inventoried_by = User::join('positions', 'positions.id', '=', 'users.id')
            ->where('users.id', $item->inventoried_by)->first(['users.name', 'positions.position']);

        return view('listing.item', ['item' => $item, 'serials' => $serials]);
    }

    public function apiSelect(Request $request)
    {
        $item = ItemProfile::where('id', $request->id)->first();

        if ($item)
            $response['status'] = 200;
        else
            $response['status'] = 400;

        return response()->json($response);
    }

    public function apiEdit(Request $request)
    {
        $item = ItemProfile::where('id', $request->id)->first();

        if ($item) {
            $response['status'] = 200;
            $response['item'] = $item;
        } else
            $response['status'] = 400;

        return response()->json($response);
    }

    public function update(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'inventory_number' => 'required',
            'purchase_date' => 'required',
            'classification' => 'required',
            'purchase_price' => 'required',
            'depreciation' => 'required',
            'warranty' => 'required',
            'supplier' => 'required'
        ]);

        ItemProfile::where('id', $request->id)->update($formFields);
        return back()->with('alert', 'Changes has been saved!');
    }

    public function destroy(Request $request)
    {
        SerialNumber::where('reference_no', $request->id)->delete();
        ItemProfile::where('id', $request->id)->delete();
        return redirect()->route('item.list')->with('alert', 'Item profile has been deleted!');
    }
}
