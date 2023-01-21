@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="p-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-auto p-2">Item profiles</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Inventory No.</th>
                                    <th scope="col">Date Purchased</th>
                                    <th scope="col">Classification</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td class="w-25 text-truncate">
                                            <img class="item_image"
                                                src="{{ $item->image ? asset('storage/' . $item->image) : asset('imgs/BFP Logo.png') }}"
                                                alt="">
                                            {{ $item->title }}
                                        </td>
                                        <td>{{ $item->inventory_number }}</td>
                                        <td>{{ $item->purchase_date }}</td>
                                        <td>{{ $item->classification }}</td>
                                        <td>{{ Auth::user()->countItem($item->id) }}x</td>
                                        <td>
                                            <button type="button" class="btn my-bg-primary rounded-5 p-0" id="select-item"
                                                value="{{ $item->id }}">
                                                <small class="p-3 text-white">See details</small>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $items->links() }}
    </div>
@endsection
