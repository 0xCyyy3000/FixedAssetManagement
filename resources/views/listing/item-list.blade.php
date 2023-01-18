@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="p-2">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-auto p-2">List of items</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Inventory No.</th>
                                    <th scope="col">Date Purchased</th>
                                    <th scope="col">Condition</th>
                                    <th scope="col">Classification</th>
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
                                            {{ $item->title }} asdf 0asdf 0asdf -asdf 0a-sfd 0
                                        </td>
                                        <td>{{ $item->inventory_number }}</td>
                                        <td>{{ $item->purchase_date }}</td>
                                        <td>{{ $item->classification }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>
                                            <button type="button"
                                                class="btn text-start rounded-5 p-0 bg-warning text-white"
                                                data-toggle="modal" data-target="#exampleModal" id="edit-item-list"
                                                value="{{ $item->transaction_no }}">
                                                <small class="p-3 my-primary">See details</small>
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
    <!-- Edit Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content  ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal-xl">

                    <form method="POST" action="ItemListEdit" id="updateForm">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="transaction_number" class="form-label">Transaction Number</label>
                                        <input type="text" class="form-control" id="transaction_number"
                                            name="transaction_number" value="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3 ">
                                        <label for="date" class="form-label">Purchased Date</label>
                                        <input type="text" id="date" class="form-control" name="purchase_date"
                                            value="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Purchase Price</label>
                                        <input type="text" class="form-control" id="price" name="purchase_price"
                                            value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="inventory_number" class="form-label">Inventory Number</label>
                                        <input type="text" class="form-control" id="inventory_number"
                                            name="inventory_number" value="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <select id="type" name="type" class="form-control">
                                            <option value="Machine">Machine</option>
                                            <option value="plant">plant</option>
                                            <option value="Tangible">Tangible</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="salvage_value" class="form-label"> Salvage Value</label>
                                        <input type="text" class="form-control" id="salvage_value"
                                            name="salvage_value" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="serial_number" class="form-label">Serial Number</label>
                                        <input type="text" class="form-control" id="serial_number"
                                            name="serial_number" value="">
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="classication" class="form-label">Classification</label>
                                        <input type="text" class="form-control" id="classification"
                                            name="classification" value="">
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="lifespan" class="form-label">Lifespan</label>
                                        <input type="text" class="form-control" id="lifespan" name="lifespan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="department" class="form-label">Department</label>
                                        <input type="text" class="form-control" id="department" name="department">
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="qty" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" id="qty" name="quantity">
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="operatin_cost" class="form-label">Annual Operating
                                            Cost</label>
                                        <input type="text" class="form-control" id="operating_cost"
                                            name="annual_operating_cost">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="year" class="form-label">Year</label>
                                        <input type="text" class="form-control" id="year" name="year">
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="replacement_value" class="form-label">Replacement Value</label>
                                        <input type="text" class="form-control" id="replacement_value"
                                            name="replacement_value">
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="inventoried_by" class="form-label">Inventoried By</label>
                                        <input type="text" class="form-control" id="inventoried_by"
                                            value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="trade_in_value" class="form-label">Trade in Value</label>
                                        <input type="text" class="form-control" id="trade_in_value"
                                            name="trade_in_value">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="body" class="form-label">Body</label>
                                        <input type="text" class="form-control" id="body" name="body">
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="present_value" class="form-label">Present Value</label>
                                        <input type="text" class="form-control" id="present_value"
                                            name="present_value">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label for="comment">Comments</label>
                                        <textarea class="form-control" id="comment" rows="2" name="comments"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-20">
                                <div class="form-group">
                                    <label for="note">Notes</label>
                                    <textarea class="form-control" id="note" rows="5" name="notes"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button class="btn btn-primary float-right" type="submit">Save changes</button>
                            </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
