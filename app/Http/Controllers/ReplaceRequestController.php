<?php

namespace App\Http\Controllers;

use App\Models\ReplaceRequest;
use Illuminate\Http\Request;

class ReplaceRequestController extends Controller
{
    public function index()
    {
        $requests = ReplaceRequest::latest()->paginate(10);
        return view('requests.replace.index', ['requests' => $requests]);
    }

    public function create()
    {
        return view('requests.replace.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
