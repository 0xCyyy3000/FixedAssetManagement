<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if ($request->hasFile('photo')) {
            $thumbnail = $request->file('photo')->store('photos', 'public');
            User::where(Auth::user()->id, $request->id)->update([
                'photo' => $thumbnail
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
        
        $formFields = $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        User::where('id', $request->id)->update($formFields);
        return back()->with('alert', 'Changes has been saved!');
    }
}
