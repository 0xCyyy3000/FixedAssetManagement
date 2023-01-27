<?php

namespace App\Http\Controllers;

use App\Models\ItemsReplace;
use Illuminate\Http\Request;

class ItemsReplaceController extends Controller
{
    //
    public function additem(Request $request)
    {
        ItemsReplace::create([
            'item' => $request->input('item'),
            'description' => $request->input('description'),
            'qty' => $request->input('qty'),
            'unit' => $request->input('unit'),
            'price' => $request->input('price'),
            'total' => $request->input('total'),
        ]);

        return redirect('/RepairRequest');
    }
}
