 
@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center px-2">
            <div class="container p-0 bg-white rounded request-information">
                <div class="d-flex center px-3 pt-3 pb-0 justify-content-between">
                    <div class="container">
                        <h1 class="fw-bolder fs-2 mb-0" style="">Reports</h1>
                        <p class="fs-6 fw-light">{{ \Carbon\Carbon::now()->format('M. d, Y') }}</p>
                    </div>
                    <div class="container">
                        <h1 class="text-center pt-1 mb-0 fw-semibold">
                            Republic of the Philippines <br> Department of Interior and Local Government <br> Bureau of Fire
                            Protection
                        </h1>
                    </div>
                    <div class="container">
                        <a href="{{ route('view') }}"class="btn my-bg-primary btn-sm float-end text-white">Download PDF</a>
                    </div>
                </div>
                <hr>
                @foreach ($data as $items)
                @php
                $total = 0;
                $total += $items->price 
                @endphp
                
               <p class="float-end gap-2 p-3 w-3 fs-4 fst-normal" scope="col">Total Inventroy Value: <Span class="my-bg- w-1 fw-bold"> ₱ {{ $total }}</Span></p>
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
                                   
                                    <th scope="col" class="p-3">Serial</th>
                                    <th scope="col" class="p-3">Condition</th>
                                    <th scope="col" class="p-3">Color</th>
                                    <th scope="col" class="p-3">Location</th>
                                    <th scope="col" class="p-3">Lifespan</th>
                                    <th scope="col" class="p-3">Depreciation</th>
                                    <th scope="col" class="p-3">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                               
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $items->inventory_number }}</td>
                                        <td>{{ $items->title }}</td>
                                        <td>{{ $items->description }}</td>
                                        <td>{{ $items->classification }}</td>
                                        <td>{{ $items->date }}</td>
                                        
                                        <td>{{ $items->serial_no }}</td>
                                        <td>{{ $items->condition }}</td>
                                        <td>{{ $items->color }}</td>
                                        <td>{{ $items->location }}</td>
                                        <td>{{ $items->lifespan }}</td>
                                        <td>{{ $items->depreciation_value }}</td>
                                        <td>{{ $items->price }}</td>
                                       
                                    </tr>
                                   
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
