{{-- @extends('layouts.layout')
@section('content')
    <script src="{{ asset('js/itemProfile.js') }}"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="p-1">
                <div class="card">
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="{{ url('/ProfileItem/store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-4">
                                    <label for="colFormLabelSm">Purchase Date</label>
                                    <input type="text" autocomplete="off" class="form-control" name="purchase_date"
                                        id="date">
                                </div>
                                <div class="col-4">
                                    <label for="photo"> Item Image </label>
                                    <input type="file" class="form-control" name="photo" id="photo" />
                                </div>

                            </div>

                            <div class="row g-3">
                                <div class="col-4">
                                    <label for="colFormLabelSm">Inventory Number</label>
                                    <input type="text" class="form-control" name="inventory_number"
                                        id="inventory_number">
                                </div>
                                <div class="col-4">
                                    <label for="colFormLabelSm">Condition</label>
                                    <select class="form-select" aria-label="Default select example" name="type"
                                        id="type">
                                        <option value="Machine">Machine</option>
                                        <option value="Plant">Plant</option>
                                        <option value="Tangible">Tangible</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="colFormLabelSm">Inventoried By</label>
                                    <input type="text" class="form-control" readonly name="user"
                                        value="{{ Auth::user()->name }}">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-4">
                                    <label for="colFormLabelSm">Notes</label>
                                    <input type="text" class="form-control" name="notes" id="notes">
                                </div>
                                <div class="col-4">
                                    <label for="colFormLabelSm">Classification</label>
                                    <select class="form-select" aria-label="Default select example" name="classification"
                                        id="classification">
                                        <option value="Functional">Functional</option>
                                        <option value="Non-Functional">Non-Functional</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row g-3">
                                <div class="col-4">
                                    <label for="colFormLabelSm">Department</label>
                                    <input type="text" class="form-control" name="department" id="department">
                                </div>
                                <div class="col-4">
                                    <label for="colFormLabelSm">Purchase Price</label>
                                    <input type="text" class="form-control" name="purchase_price" id="purchase_price">
                                </div>

                            </div>


                            <div class="row g-3">
                                <div class="col-4">
                                    <label for="colFormLabelSm">Year</label>
                                    <input type="text" class="form-control" name="year" id="year">
                                </div>
                                <div class="col-4">
                                    <label for="colFormLabelSm">Depreciation</label>
                                    <input type="text" class="form-control" name="depreciation" id="depreciation">
                                </div>
                            </div>


                            <div class="row g-3">
                                <div class="col-4">
                                    <label for="colFormLabelSm">Title</label>
                                    <input type="text" class="form-control" name="title" id="title">
                                </div>
                                <div class="col-4">
                                    <label for="colFormLabelSm">Useful Life</label>
                                    <input type="text" class="form-control" name="lifespan" id="lifespan">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-4">
                                    <label for="colFormLabelSm">Description</label>
                                    <input type="text" class="form-control" name="description" id="description">
                                </div>
                                <div class="col-4" id="serial_input">
                                    <label for="colFormLabelSm">Serial Number</label>
                                    <input type="text" class="form-control" id="serial_no">
                                    <button class="btn btn-primary me-md-2" type="button" id="btn_serial">Add</button>
                                    <table class="table mb-3">
                                        <thead class="table-light">
                                            <th scope="col">Serial No.</th>
                                        </thead>
                                        <tbody id="serials-table-body"></tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary me-md-2" type="submit" id="sumbit-reg">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.layout')
@section('content')
<script src="{{ asset('js/itemProfile.js') }}"></script>
    <div class="container">
        <div class="row justify-content-center px-2">
            <div class="container bg-white rounded request-information">
                <div class="row p-3 pb-0 mb-5 sticky-top bg-white shadow">
                     <p class="text-center fs-3 fw-bolder">Fixed Asset Inventroy Form</p>               
                </div>
                <div class="row mb-3">
                    <h3 class="text-center fs-4">Item Description</h3>
                </div>
                <div class="row p-3">
                    <div class="row w-75 m-auto">
                        <div class="mb-2 col-6">
                            <label for="inventory_number" class="form-label">Inventory Number</label>
                            <input type="text" class="form-control" id="inventory_number" name="inventory_number">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="transaction_no" class="form-label">Year</label>
                            <input type="text" class="form-control" id="year" name="year">
                        </div>
                       
                    </div>
                    <div class="row w-75 m-auto">
                        <div class="mb-2 col-6">
                            <label for="description" class="form-label ps-0">Classification</label>
                                    <select class="form-select" aria-label="Default select example" name="classification"
                                        id="classification">
                                        <option value="Land">Land</option>
                                        <option value="Buildings">Buildings</option>
                                        <option value="Office Equipment">Office Equipment</option>
                                        <option value="Appliances">Appliances</option>
                                        <option value="Vehicle">Vehicle</option>
                                    </select>
                        </div>
                        <div class="mb-2 col-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="row w-75 m-auto mb-3">
                        <div class="m-auto col-20">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control rounded m-auto"></textarea>
                            <p class="fw-light mb-1">Give the item a short and clear description.</p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <h3 class="text-center fs-4">Purchase Information</h3>
                    </div> 
                    <div class="row w-75 m-auto">
                        <div class="mb-3 col-6">
                            <label for="purchase_date" class="form-label">Purchase Date</label>
                            <input type="text" class="form-control" id="date" name="purchase_date">
                        </div>
                        <div class="mb-2 col-6">
                            <label for="purchase_price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="purchase_price" name="purchase_price">
                        </div>
                    </div>
                    <div class="row w-75 m-auto">
                        <div class="mb-3 col-6">
                            <label for="purchase_date" class="form-label">Warranty Expirations??</label>
                            <input type="text" class="form-control" id="date" name="purchase_date">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="purchase_price" class="form-label">Supplier??</label>
                            <input type="text" class="form-control" id="date" name="purchase_price">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <h3 class="text-center fs-4">Media and Thumbnail</h3>
                    </div> 
                    <div class="row w-75 m-auto">
                        <div class="mb-2 col-6">
                            <label for="photo"></label>
                            <input type="file" class="form-control" name="photo" id="photo" />
                        </div>
                        <div class="mb-2 col-6">
                            <label for="photo"></label>
                            <input type="file" class="form-control" name="photo" id="photo" />
                        </div>
                    </div>

                    <div class=" mt-5 mb-3">
                        <div class="mb-2 col-6" id="serial_input">
                            <label for="serial">Serial Number</label>
                            <input type="text" class="form-control" id="serial_no">
                            <button class="btn btn-primary me-md-2" type="button" id="btn_serial">Add</button>
                            <table class="table mb-3">
                                <thead class="table-light">
                                    <th scope="col">Serial No.</th>
                                </thead>
                                <tbody id="serials-table-body"></tbody>
                            </table>
                        </div>
                    </div>
                        {{-- <table class="table mb-3">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Serial No.</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Lifespan</th>
                                    <th scope="col">Department</th>
                                    <th scope="col">Type</th>
                                </tr>
                            </thead>
                            <tbody id="serials-table-body"></tbody>
                        </table> --}}
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary me-md-2" type="submit" id="sumbit-reg">Register</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection
