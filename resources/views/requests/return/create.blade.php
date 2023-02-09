@extends('layouts.layout')
@section('content')
    <div class="overflow-hidden p-2 pt-1">
        <div class="row justify-content-center px-2">
            <div class="container bg-white rounded request-information">
                <div class="row p-3 pb-0 mb-5 sticky-top shadow">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item fs-5 text-decoration-underline"><a
                                    href="{{ route('return.request') }}">Return Requests</a></li>
                            <li class="breadcrumb-item fs-5" aria-current="page">Create</li>
                        </ol>
                    </nav>
                </div>
                <div class="row p-3">
                    <div class="row mb-3">
                        <h3 class="text-center fw-semibold">Return Request Form</h3>
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
                            <label for="return_date" class="form-label">Date</label>
                            <p type="text" class="form-control"><?php echo date('Y-m-d'); ?></p>
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
                            <button class="btn my-btn-primary" id="add-return-request-item" type="button"
                                data-toggle="modal" data-target="#return_request_item">Add item</button>
                        </div>
                        <table class="table mb-3">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Serial No.</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="return-items-table-body"></tbody>
                        </table>
                        <h4 class="text-end d-none" id="return-items-total"></h4>
                    </div>
                    <div class="row p-3">
                        <label for="note" class="form-label ps-0">Purpose</label>
                        <textarea name="note" id="note" class="w-100 p-2 rounded m-auto"></textarea>
                    </div>
                    <div class="d-flex p-3 justify-content-end gap-2">
                        <input type="hidden" id="return_token" value="{{ csrf_token() }}">
                        <a href="{{ route('return.request') }}" class="btn btn-secondary">Cancel</a>
                        <button type="button" class="btn my-btn-primary" id="submit-return" name="submit_return">Submit
                            request</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="return_request_item" tabindex="-1" aria-labelledby="return_request_itemLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title fs-4" id="return_request_itemLabel">Item form</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body row">
                        <div class="mb-3 col-6">
                            <label for="item" class="form-label">Item</label>
                            <select class="form-select" id="return_item" name="item">
                                <option value=""></option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="serial_no" class="form-label">Serial No.</label>
                            <select id="return_serial_no" class="form-select" name="serial_no">
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="return_description" name="description">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="remarks" class="form-label">Remarks</label>
                            <input type="text" class="form-control" id="return_remarks" name="remarks">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="cost" class="form-label">Cost</label>
                            <input type="number" class="form-control" id="return_cost" name="cost" value="0">
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-secondary" data-dismiss="modal" id="cancel" type="button">
                                Cancel
                            </button>
                            <button class="btn my-btn-primary text-white" id="add-item-return" type="button">
                                Submit item
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
