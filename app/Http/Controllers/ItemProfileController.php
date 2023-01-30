<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ItemMedia;
use App\Models\ItemProfile;
use App\Models\Transaction;
use App\Models\SerialNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\Console\Input\Input;

class ItemProfileController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        if ($request->hasFile('photo') && $request->hasFile('media1')  && $request->hasFile('media2') && $request->hasFile('media3')) {
            $imagePath = $request->file('photo')->store('photos', 'public');
            $media1 = $request->file('media1')->store('photos', 'public');
            $media2 = $request->file('media2')->store('photos', 'public');
            $media3 = $request->file('media3')->store('photos', 'public');
        } else $imagePath = null;

        $newTransaction = Transaction::create(['content' => 'New Asset added by ' . Auth::user()->name]);
        $newRequest = ItemProfile::create([
            'transaction_no' => $newTransaction->id,
            'purchase_date' => $request->purchase_date,
            'inventory_number' => $request->inventory_number,
            'classification' => $request->classification,
            'year' => $request->year,
            'title' => $request->title,
            'depreciation' => $request->depreciation,
            'description' => $request->description,
            'notes' => null,
            'image' => $imagePath,
            'notes' => $request->notes,
            'inventoried_by' => Auth::user()->id,
            'supplier' => $request->supplier,
            'warranty' => $request->warranty
        ]);

        if ($newRequest) {
            ItemMedia::create([
                'item_id' => $newRequest->id,
                'media1' => $media1,
                'media2' => $media2,
                'media3' => $media3,
            ]);

            foreach ($request->serials as $key => $value) {
                $lifespan = $request->lifespans[$key];
                $location = $request->locations[$key];
                $color = $request->colors[$key];
                $price = $request->prices[$key];
                $condition = $request->conditions[$key];

                SerialNumber::create([
                    'reference_no' => $newRequest->id,
                    'serial_no' => $value,
                    'condition' => $condition,
                    'price' => $price,
                    'lifespan' => $lifespan,
                    'location' => $location,
                    'color' => $color
                ]);
            }
            return back()->with('alert', 'Item profile added!');
        }
    }

    public function create()
    {
        return view('listing.item-profile');
    }
    public function view()
    {
        // if (!Gate::allows('admin', Auth::user())) {
        //     abort(404);
        // }
        $data = ItemProfile::all();
        return view('listing.item-list', ['items' => $data]);
    }

    public function select(Request $request)
    {
        $item = ItemProfile::where('id', $request->id)->first();
        $serials = SerialNumber::join('item_profiles', 'item_profiles.id', '=', 'serial_numbers.reference_no')
            ->where('serial_numbers.reference_no', $request->id)
            ->select(['item_profiles.*', 'serial_numbers.*'])->paginate(5);

        $item->inventoried_by = User::join('positions', 'positions.id', '=', 'users.id')
            ->where('users.id', $item->inventoried_by)->first(['users.name', 'positions.position']);

        $medias = ItemMedia::where('item_id', $request->id)->first();
        // dd($medias);
        return view('listing.item', ['item' => $item, 'serials' => $serials, 'medias' => $medias]);
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
        // dd($request);
        $formFields = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'inventory_number' => 'required',
            'purchase_date' => 'required',
            'classification' => 'required',
            'depreciation' => 'required',
            'warranty' => 'required',
            'supplier' => 'required'
        ]);

        ItemProfile::where('id', $request->id)->update($formFields);
        return back()->with('alert', 'Changes has been saved!');
    }

    public function destroy(Request $request)
    {
        ItemMedia::where('item_id', $request->id)->delete();
        SerialNumber::where('reference_no', $request->id)->delete();
        ItemProfile::where('id', $request->id)->delete();
        return redirect()->route('item.list')->with('alert', 'Asset has been deleted!');
    }


    public function updatephoto(Request $request)
    {
        $count = 0;
        foreach ($request->all() as $key => $value) {
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('photos', 'public');
                ItemMedia::where('item_id', $request->id)->update([$key => $path]);
                $count++;
            }
        }

        if ($count) {
            return back()->with('alert', 'Changes has been saved!');
        } else
            return back()->with('alert', 'Please select an item to upload!');
    }

    public function updateThumbnail(Request $request)
    {
        if ($request->hasFile('thumbnail')) {
            $thumnail = $request->file('thumbnail')->store('photos', 'public');
            ItemProfile::where('id', $request->id)->update([
                'image' => $thumnail
            ]);
            return back()->with('alert', 'Thumbnail has been changed!');
        } else return back()->with('alert', 'Please select a photo');
    }
}
