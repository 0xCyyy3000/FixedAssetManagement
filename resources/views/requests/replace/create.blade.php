@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center px-2">
            <div class="container bg-white rounded request-information">
                <div class="row p-3 pb-0 mb-5 sticky-top bg-white shadow">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item fs-5 text-decoration-underline"><a
                                    href="{{ route('replace.request') }}">Replace Requests</a></li>
                            <li class="breadcrumb-item fs-5" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
                <div class="row p-3">
                    <div class="row mb-3">
                        <h3 class="text-center fw-semibold">Replace Request Form</h3>
                    </div>
                    <form action="{{ route('replace.store') }}" method="POST" class="p-3">
                        @csrf
                        <div class="row w-75 m-auto">
                            <div class="mb-3 col-4">
                                <label for="entity" class="form-label">Entity Name</label>
                                <input type="text" class="form-control" id="entity" name="entity">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="fund_cluster" class="form-label">Fund Cluster</label>
                                <input type="text" class="form-control" id="fund_cluster" name="fund_cluster">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="replace_date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="replace_date" name="date"
                                    value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="row w-75 m-auto mb-3">
                            <div class="mb-3 col-4">
                                <label for="section" class="form-label">Office Section</label>
                                <input type="text" class="form-control" id="section" name="section">
                            </div>
                            <div class="mb-3 col-4">
                                <label for="appendix_no" class="form-label">Appendix No.</label>
                                <input type="text" class="form-control" id="appendix_no" name="appendix_no">
                            </div>
                        </div>
                        <div class="container mt-5 mb-3">
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn my-btn-primary" type="button" data-toggle="modal"
                                    data-target="#exampleModal" id="edit-item-list">Add item</button>
                            </div>
                            <table class="table mb-3">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Serial No.</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Remarks</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                        <td>{{ 'serial test' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4 class="text-end">Total: ₱{{ '1423' }}</h4>
                        </div>
                        <div class="row p-3">
                            <label for="note" class="form-label ps-0">Note</label>
                            <textarea name="note" id="note" class="w-100 p-2 rounded m-auto"></textarea>
                        </div>
                        <div class="row p-3 w-25">
                            <label for="status" class="form-label ps-0">Status</label>
                            <select class="form-select" id="status">
                                <option value="pending">Pending</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="d-flex p-3 justify-content-end gap-2">
                            <button type="submit" class="btn my-btn-primary">Submit Form</button>
                            <a href="{{ route('replace.request') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adding Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/additem" id="item-form">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="serial_no" class="form-label">Serial No.</label>
                                    <input type="text" id="serial_no" class="form-control" name="serial_no">
                                </div>
                                <div class="mb-3 col">
                                    <label for="item" class="form-label">Item</label>
                                    <input type="text" class="form-control" id="item" name="item">
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <input type="text" class="form-control" id="description" name="description">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="text" id="quantity" class="form-control" name="quantity">
                                </div>
                                <div class="mb-3 col">
                                    <label for="unit" class="form-label">Unit</label>
                                    <input type="text" class="form-control" name="unit" id="unit">
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="inventory_number" class="form-label">Total</label>
                                        <input type="text" class="form-control" name="total">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary float-right" form="item-form" type="submit">Save
                                            changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
