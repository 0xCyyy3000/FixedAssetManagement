@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="p-1">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="" enctype="">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Entity Name</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                name="entity_name" value="{{ old('entity_name') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="mb-3 ">
                                            <label for="date" class="form-label">Fund Cluster</label>
                                            <input type="text" class="form-control" id="" name="fund_cluster"
                                                value="{{ old('fund_cluster') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="mb-3">
                                            <label for="date" class="form-label">Date</label>
                                            <input type="text" class="form-control" id="date" name="date"
                                                value="{{ old('date') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Office
                                                SEction</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                name="office_sec" value="{{ old('office_sec') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Purchase Rq
                                                No.</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                name="purchase_id" value="{{ old('purchase_id') }}">
                                        </div>
                                        @error('type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Transaction
                                                No.</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                name="transaction_no" value="{{ old('transaction_no') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Appendic
                                                No.</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                                name="appendix_no" value="{{ old('appendix_no') }}">
                                        </div>
                                        @error('serial_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-20">
                                            <div class="form-group mb-3">
                                                <label for="exampleFormControlTextarea1">Purpose</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="purpose"
                                                    value="{{ old('purpose') }}"></textarea>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="notes"
                                                    value="{{ old('notes') }}"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                                data-target="#exampleModal" id="edit-item-list">Add item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"> </th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($items as $items)
                                        <td>Sample Serial No.</td>
                                        <td>{{ $item->item }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->unit }}</td>
                                        <td>{{ $item->price }}</td>
                                    @endforeach

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="sumbit">Submit</button>
                        <button class="btn btn-primary me-md-2" type="button" id="btn">Button</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/additem" id="item-form">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="transaction_number" class="form-label">Item</label>
                                        <input type="text" class="form-control" name="item">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="mb-3 ">
                                    <label for="date" class="form-label">Description</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Unit</label>
                                    <input type="text" class="form-control" name="unit">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mb-3">
                                <label for="inventory_number" class="form-label">Price</label>
                                <input type="text" class="form-control" name="price">
                            </div>
                            <div class="col-sm">
                                <div class="mb-3">
                                    <label for="inventory_number" class="form-label">Quantity</label>
                                    <input type="text" class="form-control" name="qty">
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="inventory_number" class="form-label">Total</label>
                                        <input type="text" class="form-control" name="total">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary float-right" form="item-form" type="submit">Save
                                        changes</button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
