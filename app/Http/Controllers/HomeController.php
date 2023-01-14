<?php

namespace App\Http\Controllers;

use App\Models\ItemProfile;
use Illuminate\Http\Request;

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
        $item = ItemProfile::latest()->paginate(10);
        return view('listing.item-list', ['items' => $item]);
    }
}
