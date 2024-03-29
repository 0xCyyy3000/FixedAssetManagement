@extends('layouts.layout')
@section('content')
    <div class="overflow-hidden p-3 pt-2">
        <div class="row justify-content-center px-2">
            <div class="container p-0 bg-white rounded request-information">
                <div class="row p-3 pb-0 mb-5 bg-white shadow">
                    <p class="text-start fs-3 fw-bolder">Inventroy Form</p>
                    @if (session('error'))
                        <div class="w-75 m-auto mb-3 alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Something went wrong!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <h3 class="text-center fs-4">Item Description</h3>
                </div>
                <form class="row p-3" method="POST" enctype="multipart/form-data" action="{{ route('itemstore') }}">
                    @csrf
                    <div class="row w-75 m-auto mb-3">
                        <div class="mb-2 col-6">
                            <label for="name" class="form-label">Name</label>
                            <input required type="text" class="form-control @error('title') is-invalid @enderror"
                                id="title" name="title" value="{{ old('title') }}">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="transaction_no" class="form-label @error('year') is-invalid @enderror">Year</label>
                            <input required type="number" value="{{ old('year') }}" class="form-control" id="year"
                                name="year">

                            @error('year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row w-75 m-auto mb-3">
                        <div class="mb-2 col-6">
                            <label for="description"
                                class="form-label ps-0 @error('classification') is-invalid @enderror">Classification</label>
                            <select required class="form-select" aria-label="Default select example" name="classification"
                                id="classification">
                                <option value="Land">Land</option>
                                <option value="Buildings">Buildings</option>
                                <option value="Office Equipment">Office Equipment</option>
                                <option value="Appliances">Appliances</option>
                                <option value="Vehicle">Vehicle</option>
                            </select>

                            @error('classification')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- <div class="mb-3 col-6">
                            <label for="depreciation" class="form-label">Salvage Value</label>
                            <input required type="number" class="form-control" id="depreciation" name="depreciation">
                        </div> --}}
                    </div>
                    <div class="row w-75 m-auto mb-5">
                        <div class="m-auto col-20">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control rounded m-auto"
                                placeholder="Give the item a short and clear description"></textarea>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <h3 class="text-center fs-4">Thumbnail</h3>
                    </div>

                    <div class="row w-75 m-auto mt-0">
                        <div class="col-6 mt-0">
                            <label for="photo"></label>
                            <input required type="file" value="{{ old('photo') }}" class="form-control" name="photo"
                                id="photo" />
                        </div>
                    </div>

                    <div class="row mt-5">
                        <h3 class="text-center fs-4">Media</h3>
                    </div>
                    <div class="row w-75 m-auto">
                        <div class="mb-2 col-6">
                            <label for="media"></label>
                            <input required type="file" value="{{ old('media1') }}" class="form-control" name="media1"
                                id="media" />
                        </div>
                        <div class="mb-2 col-6">
                            <label for="media"></label>
                            <input required type="file" value="{{ old('media2') }}" class="form-control" name="media2"
                                id="media" />
                        </div>
                        <div class="mb-5 col-6">
                            <label for="media"></label>
                            <input required type="file" value="{{ old('media3') }}" class="form-control" name="media3"
                                id="media" />
                        </div>
                    </div>

                    <div class="row mb-2">
                        <h3 class="text-center fs-4">Item information form</h3>
                    </div>
                    <div class="row w-75 m-auto">
                        <div class="mb-2 col-6">
                            <label for="ip_serial_no" class="form-label">Serial</label>
                            {{-- <input type="text" class="form-control" id="ip_serial_no"> --}}
                            <div class="input-group">
                                <input type="text" class="form-control" id="ip_serial_no">
                                <button class="btn btn-outline-secondary" type="button" id="btn-listen">Listen</button>
                            </div>
                        </div>
                        {{-- <div class="mb-2 col-6">
                            <label for="ip_lifespan" class="form-label">Lifespan</label>
                            <input type="text" class="form-control" id="ip_lifespan">
                        </div> --}}
                        <div class="mb-2 col-6">
                            <label for="ip_location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="ip_location">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="ip_color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="ip_color">
                        </div>

                        <div class="mb-3 col-6">
                            <label for="ip_price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="ip_price" name="ip_price">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="ip_condition" class="form-label">Condition</label>
                            <select class="form-select" aria-label="Default select example" id="ip_condition">
                                <option value="Functional">Functional</option>
                                <option value="Non-Functional">Non-Functional</option>
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="ip_date" class="form-label">Purchase Date</label>
                            <input type="text" class="form-control" readonly id="ip_date" name="ip_date">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="ip_warranty" class="form-label">Warranty Expiration</label>
                            <input type="date" class="form-control" id="ip_warranty" name="ip_warranty">
                        </div>
                        <div class="row mb-0">
                            <h3 class="text-center fs-4"> Supplier Information</h3>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="ip_supplier" class="form-label">Supplier</label>
                            <input type="text" class="form-control" id="ip_supplier" name="ip_supplier">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="ip_address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="ip_address" name="ip_address">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="ip_contact_no" class="form-label">Contact no.</label>
                            <input type="text" class="form-control" id="ip_contact_no" name="ip_contact_no">
                        </div>
                        <div class="col-12">
                            <button class="btn my-btn-primary w-100" type="button" id="ip_btn_serial">Add item</button>
                            <button class="btn bg-transparent w-100 mt-2 my-danger d-none" type="button"
                                id="ip_btn_cancel">
                                Cancel
                            </button>
                        </div>
                        <div class="mb-5 mt-5">
                            <table class="table mb-3">
                                <thead class="table-light">
                                    <th scope="col">Serial No.</th>
                                    <th scope="col">Condition</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Warranty</th>
                                    <th scope="col">Purchase Date</th>
                                    <th scope="col">Color</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Supplier</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Contact No.</th>
                                    <th scope="col">Action</th>
                                </thead>
                                <tbody id="ip_serials-table-body"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row w-75 m-auto">
                        <div class="mb-5 col-6">
                            <label for="colFormLabelSm">Inventoried By</label>
                            <input type="text" class="form-control" readonly name="user"
                                value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn my-btn-primary me-md-2" type="submit" id="ip_sumbit-reg">Submit form</button>
                    </div>
                    <div id="ip_serial_input"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
