@extends('layouts.app')
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        
        <div class="">
            
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Date Purchased</th>
                            <th scope="col">Inventory no.</th>
                            <th scope="col">Serial Number</th>
                            <th scope="col">Item</th>
                            <th scope="col">Classification</th>
                            <th scope="col">Type</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item) 
                          <tr>
                            <td>{{ $item->purchase_date}}</td>
                            <td>{{ $item->inventory_number}}</td>
                            <td>{{ $item->serial_number}}</td>
                            <td>{{ $item->title}}</td>
                            <td>{{ $item->classification}}</td>
                            <td>{{ $item->type}}</td>
                            <td>{{ $item->quantity}}</td>
                            <td>Actions</td>
                          </tr>
                        </tbody>
                        @endforeach
                      </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
