@extends('layouts.layout')
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
                                    <label for="colFormLabelSm">Type</label>
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
@endsection
