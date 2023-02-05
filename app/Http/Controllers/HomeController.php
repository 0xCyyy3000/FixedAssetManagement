<?php

namespace App\Http\Controllers;

use App\Models\ItemProfile;
use App\Models\SerialNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home()
    {
        return redirect()->route('dashboard');
    }

    public function dashboard()
    {
        return view('home', ['page' => 'Dashboard']);
    }

    public function itemList()
    {
        if (!Gate::allows('admin', Auth::user())) {
            abort(403);
        }
        $items = ItemProfile::latest()->paginate(8);
        return view('listing.item-list', ['items' => $items]);
    }
}
