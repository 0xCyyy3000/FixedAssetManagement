@extends('layouts.layout')
@section('content')

    <head>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>
    <div class="container">
        <div class="row justify-content-center">
            <div class="">

                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <form method="POST" action="/latest" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Transaction Number</label>
                                        <input type="text" class="form-control"
                                            value="{{ $transaction->transaction_number }}" disabled>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Purchase Date</label>
                                        <input type="text" name="purchase_date" class="form-control"
                                            value="{{ $transaction->purchase_date }}" id="datepicker">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Type</label>
                                        <select id="type" name="type" class="form-control"
                                            value="{{ $transaction->type }}">>
                                            <option value="Machine">Machine</option>
                                            <option value="plant">plant</option>
                                            <option value="Tangible">Tangible</option>
                                        </select>
                                        {{-- <input type="text" name="type" class="form-control" id="exampleFormControlInput1" value="{{ $transaction->type}}"> --}}
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Classification</label>
                                        <input type="text" name="classification" class="form-control"
                                            id="exampleFormControlInput1" value="{{ $transaction->classification }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                                        <input type="text" name="quantity" class="form-control"
                                            id="exampleFormControlInput1" value="{{ $transaction->quantity }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Replacement Value</label>
                                        <input type="text" name="replacement_value" class="form-control"
                                            id="exampleFormControlInput1" value="{{ $transaction->replacement_value }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Trade in Value</label>
                                        <input type="text" name="trade_in_value" class="form-control"
                                            id="exampleFormControlInput1" value="{{ $transaction->trade_in_value }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Present Value</label>
                                        <input type="text" name="present_value" class="form-control"
                                            id="exampleFormControlInput1" value="{{ $transaction->present_value }}">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Purchase Price</label>
                                        <input type="text" name="purchase_price" class="form-control"
                                            id="exampleFormControlInput1" value="{{ $transaction->purchase_price }}">
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label for="exampleFormControlInput1" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="exampleFormControlInput1" name="img">

                                    @error('img')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <button class="btn btn-primary float-right">
                                Update
                            </button>
                            <script>
                                $(function() {
                                    $("#datepicker").datepicker({
                                        autoclose: true,
                                        todayHighlight: true
                                    }).datepicker('update', new Date());
                                });
                            </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
