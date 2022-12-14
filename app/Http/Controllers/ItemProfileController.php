<?php

namespace App\Http\Controllers;

use App\Models\ItemProfile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemProfileController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        ItemProfile::create([
            'purchase_date' => $request->purchase_date
        ]);

        return redirect('/home');
    }
}
