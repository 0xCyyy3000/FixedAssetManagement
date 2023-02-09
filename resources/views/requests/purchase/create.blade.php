@extends('layouts.layout')
@section('content')
    <div class="overflow-hidden p-2 pt-1">
        <div class="row justify-content-center px-2">
            <div class="container bg-white rounded request-information">
                <div class="row p-3 pb-0 mb-5 sticky-top bg-white shadow">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item fs-5 text-decoration-underline"><a
                                    href="{{ route('purchase.request') }}">Purchase Requests</a></li>
                            <li class="breadcrumb-item fs-5" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
                <div class="row p-3">
                    <div class="row mb-3">
                        <h3 class="text-center fw-semibold">Purchase Request Form</h3>
                    </div>
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
                    <div class="overflow-hidden mt-5 mb-3">
                        <div class="d-flex justify-content-end mb-3">
                            <button class="btn my-btn-primary" type="button" id="add-purchase-request-item"
                                data-toggle="modal" data-target="#repair_request_item">Add item</button>
                        </div>
                        <table class="table mb-3">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Item description</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="items-table-body"></tbody>
                        </table>
                        <h4 class="text-end d-none" id="items-total">Total: ₱</h4>
                    </div>
                    <div class="row p-3">
                        <label for="note" class="form-label ps-0">Note</label>
                        <textarea name="note" id="note" class="w-100 p-2 rounded m-auto" placeholder="Describe your purpose"></textarea>
                    </div>
                    {{-- <div class="row p-3 w-25">
                        <label for="status" class="form-label ps-0">Status</label>
                        <select class="form-select" id="status">
                            <option value="Pending">Pending</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div> --}}
                    <div class="d-flex p-3 justify-content-end gap-2">
                        <input type="hidden" id="token" value="{{ csrf_token() }}">
                        <button type="button" class="btn my-btn-primary" id="submit-purchase">Submit Form</button>
                        <a href="{{ route('purchase.request') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="repair_request_item" tabindex="-1" aria-labelledby="repair_request_itemLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="repair_request_itemLabel">Adding Item</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="item" class="form-label">Item</label>
                            <input type="text" class="form-control" id="item" name="item">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Item description</label>
                            <input type="text" class="form-control" id="description" name="description">
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="qty" name="qty">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" class="form-control" id="total" name="total" readonly>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn my-btn-primary text-white" id="submit_item" type="submit"
                                form="item-form">
                                Submit item
                            </button>
                            <button class="btn btn-secondary" data-dismiss="modal" id="cancel" type="button">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
