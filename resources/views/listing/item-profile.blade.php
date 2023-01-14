@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="p-1">
                <div class="card">
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="/ProfileItem">
                            @csrf
                            <div class="row g-3">
                                <div class="col">
                                    <label for="colFormLabelSm">Transaction Number</label>
                                    <input type="text" class="form-control" name="transaction_number">
                                </div>
                                <div class="col">
                                    <label for="colFormLabelSm">Purchase Date</label>
                                    <input type="text" class="form-select" name="purchase_date " id="date">
                                </div>
                                <div class="col">
                                    <label for="colFormLabelSm">Notes</label>
                                    <input type="text" class="form-control" name="notes">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-4">
                                    <label for="colFormLabelSm">Inventory Number</label>
                                    <input type="text" class="form-control" name="inventory_number">
                                </div>
                                <div class="col-4">
                                    <label for="colFormLabelSm">Type</label>
                                    <select class="form-select" aria-label="Default select example" name="type">
                                        <option value="Machine">Machine</option>
                                        <option value="Plant">Plant</option>
                                        <option value="Tangible">Tangible</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label for="colFormLabelSm">Notes</label>
                                    <input type="text" class="form-control" name="notes">
                                </div>
                                <div class="col">
                                    <label for="colFormLabelSm">Classification</label>
                                    <select class="form-select" aria-label="Default select example" name="classification">
                                        <option value="Functional">Functional</option>
                                        <option value="Non-Functional">Non-Functional</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="colFormLabelSm">Inventoried By</label>
                                    <input type="text" class="form-control" disabled name="user"
                                        value="{{ Auth::user()->name }}">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label for="colFormLabelSm">Department</label>
                                    <input type="text" class="form-control" name="department">
                                </div>
                                <div class="col">
                                    <label for="colFormLabelSm">Purchase Price</label>
                                    <input type="text" class="form-control" name="purchase_price">
                                </div>
                                <div class="col">
                                    <label for="colFormLabelSm">Serial Number</label>
                                    <input type="text" class="form-control" name="serial_number" id="inputField">
                                    <button type="button" class="btn btn-primary btn-sm" id="addButton">add</button>
                                </div>
                            </div>


                            <div class="row g-3">
                                <div class="col-4">
                                    <label for="colFormLabelSm">Year</label>
                                    <input type="text" class="form-control" name="year">
                                </div>
                                <div class="col-4">
                                    <label for="colFormLabelSm">Condition</label>
                                    <input type="text" class="form-control" name="condition">
                                </div>
                            </div>


                            <div class="row g-3">
                                <div class="col-4">
                                    <label for="colFormLabelSm">Title</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                                <div class="col-4">
                                    <label for="colFormLabelSm">Useful Life</label>
                                    <input type="text" class="form-control" name="lifespan">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-4">
                                    <label for="colFormLabelSm">Description</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                                <div class="col-4">
                                    <label for="colFormLabelSm">Depreciation</label>
                                    <input type="text" class="form-control" name="depreciation">
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary me-md-2" type="Submit">Register</button>
                                <button class="btn btn-primary" type="button">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("addButton").addEventListener("click", function() {
            // Create a new input field
            var newInput = document.createElement("input");
            newInput.type = "text";
            newInput.classList.add("form-control");
    
            // Add the new input field to the form
            document.getElementById("form").appendChild(newInput);
        });
    </script>
@endsection
