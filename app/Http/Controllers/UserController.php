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
        return view('settings', ['user'=>$user]);
    }

    public function update(User $user, Request $request)
    {
        if ($request->hasFile('photo')) {
            $thumbnail = $request->file('photo')->store('photos', 'public');
            User::where(Auth::user()->id, $request->id)->update([
                'photo' => $thumbnail
            ]);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

    
        return redirect('/profile')->with('status', 'Profile updated!');
    }
} 