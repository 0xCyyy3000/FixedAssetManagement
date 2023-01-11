<?php

namespace App\Http\Controllers;

use App\Models\items;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    //
      public function additem(Request $request)
    {

        items::create([
            'item'=>$request->input('item'),
            'description'=>$request->input('description'),
            'qty'=>$request->input('qty'),
            'unit'=>$request->input('unit'),
            'price'=>$request->input('price'),
            'total'=>$request->input('total'),
        ]);

    return redirect('/RepairRequest');
    }
}
