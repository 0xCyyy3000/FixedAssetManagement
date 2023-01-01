@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="">

                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    

                        <form method="GET" >
                            @csrf
                            <div class="card-body">
                            <div class="row">
                                        <div class="col-sm">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Inventory Number</label>
                                              <input type="text" class="form-control" value="{{ $transaction->inventory_number}}" >
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Classifications</label>
                                              <input type="text" class="form-control" value="{{ $transaction->classification}}" >
                                            </div>
                                        </div>
                                      </div> 
                                      <div class="row">
                                        <div class="col-sm">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Model</label>
                                              <input type="text" class="form-control" id="exampleFormControlInput1" >
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Type</label>
                                              <input type="text" class="form-control" value="{{ $transaction->type}}" >
                                            </div>
                                        </div>
                                      </div>
                            <div class="container col-md-6">
                                        <div class="mb-3">
                                            <label for="Image" class="form-label">Upload File</label>
                                            <input class="form-control" type="file" id="formFile" onchange="preview()">
                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <button class="btn btn-primary float-right">
                                            Submit
                                        </button>
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection