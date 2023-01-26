@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center px-2">
            <div class="container p-0 bg-white rounded request-information">
                <div class=" p-3 pb-0 mb-5 bg-white shadow">
                    <p class="text-start fs-3 fw-bolder">Reports</p>
                    <a href="{{ route('view')}}"class="btn btn-primary btn-sm float-end">Download PDF</a>
                </div>
                <img src="{{ asset('imgs/BFP Logo.png') }}" style="float:left;width:100px;height:100px;">
                <div class="text-center ">
                    <h1 class="fs-4">Republic of the Ph</h1>
                    <h1 class="fs-4"> Dept of interior and local governance </h1>
                    <h1 class="fs-4"> Bureau of Fire Protection</h1>
                </div>
                <hr>
                <div class="mx-auto">
                    <h3 class="fs-5">Fixed Asset Inventory</h3>
                    <p class="fs-6">{{ \Carbon\Carbon::now()->format('d-m-Y')}}</p>
                </div>
                <hr >
                <div class=" p-3 text-center gap-2">
                    <div class="bg-white rounded-2">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th scope="col" class="p-3">No.</th>
                                    <th scope="col" class="p-3">Inventory Number</th>
                                    <th scope="col" class="p-3">Asset</th>
                                    <th scope="col" class="p-3">Model</th>
                                    <th scope="col" class="p-3">Classification</th>
                                    <th scope="col" class="p-3">Purchase Date</th>
                                    <th scope="col" class="p-3">Price</th>
                                    <th scope="col" class="p-3">Serial</th>
                                    <th scope="col" class="p-3">Condition</th>
                                    <th scope="col" class="p-3">Color</th>
                                    <th scope="col" class="p-3">Location</th>
                                    <th scope="col" class="p-3">Lifespan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $items)
                                    <tr>
                                        <td >{{ $loop->iteration }}</td>
                                        <td >{{ $items->inventory_number}}</td>
                                        <td >{{ $items->title}}</td>
                                        <td >{{ $items->description}}</td>
                                        <td >{{ $items->classification}}</td>
                                        <td >{{ $items->purchase_date}}</td>
                                        <td >{{ $items->location}}</td>
                                        <td>{{ $items->serial_no}}</td>
                                        <td >{{ $items->condition}}</td>
                                        <td >{{ $items->color}}</td>
                                        <td >{{ $items->location}}</td>
                                        <td >{{ $items->lifespan}}</td>
                                        
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table >
                        
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection
