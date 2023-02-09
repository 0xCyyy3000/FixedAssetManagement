<?php

namespace App\Http\Controllers;

use App\Models\PurchaseRequest;
use App\Models\RepairRequest;
use App\Models\ReplaceRequest;
use App\Models\ReturnRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        return view('settings', ['user' => $user]);
    }

    public function update(Request $request)
    {   
        // dd($request->all());
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('photos', 'public');
            User::where('id',Auth::user()->id)->update([
                'photo' => $photo
            ]);
        }
        
        User::where('id', Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('alert', 'Profile updated!');
    }
    public function updatepass(Request $request)
    {
        
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);


        return back()->with("status", "Profile changed successfully!");
    }

   
}
