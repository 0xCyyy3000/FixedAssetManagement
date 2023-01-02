
@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="">

                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                        <form method="POST" action="/latest">
                          @method('PUT')
                          @csrf
                            <div class="card-body">
                            <div class="row">
                                        <div class="col-sm">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label" >Transaction Number</label>
                                              <input type="text" class="form-control" value="{{ $transaction->transaction_number}}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Purchase Date</label>
                                              <input type="text" name="purchase_date" class="form-control" value="{{ $transaction->purchase_date}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Type</label>
                                                <input type="text" name="type" class="form-control" id="exampleFormControlInput1" value="{{ $transaction->type}}">
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Classification</label>
                                                <input type="text" name="classification" class="form-control" id="exampleFormControlInput1" value="{{ $transaction->classification}}">
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                                                <input type="text" name="quantity" class="form-control" id="exampleFormControlInput1" value="{{ $transaction->quantity}}">
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Replacement Value</label>
                                                <input type="text" name="replacement_value" class="form-control" id="exampleFormControlInput1" value="{{ $transaction->replacement_value}}">
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Trade in Value</label>
                                                <input type="text" name="trade_in_value" class="form-control" id="exampleFormControlInput1" value="{{ $transaction->trade_in_value}}">
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Present Value</label>
                                                <input type="text" name="present_value" class="form-control" id="exampleFormControlInput1" value="{{ $transaction->present_value}}">
                                              </div>
                                        </div>
                                        <div class="col-sm">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Purchase Price</label>
                                              <input type="text" name="purchase_price" class="form-control" id="exampleFormControlInput1" value="{{ $transaction->purchase_price}}">
                                            </div>
                                        </div>
                                      </div>
                                        <button class="btn btn-primary float-right">
                                            Update
                                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection