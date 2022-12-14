@extends('layouts.app')




@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="">

                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">

                        <form method="POST" action='{{ route('itemstore') }}'>
                            @csrf
                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Transaction Number</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="transaction_number">
                                    </div>

                                    @error('transaction_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Purchase Date</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="purchase_date">
                                    </div>
                                    @error('purchase_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Purchase Price</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="purchase_price">
                                    </div>
                                    @error('purchase_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Inventory Number</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="inventory_number">
                                    </div>
                                    @error('inventory_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Type</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="type">
                                    </div>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label"> Salvage Value</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="salvage_value">
                                    </div>
                                    @error('salvage_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Serial Number</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="serial_number">
                                    </div>
                                    @error('serial_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Classification</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="classification">
                                    </div>
                                    @error('classification')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Lifespan</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="lifespan">
                                    </div>
                                    @error('lifespan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Department</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="department">
                                    </div>
                                    @error('department')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="quantity">
                                    </div>
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Annual Operating
                                            Cost</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="annual_operating_cost">
                                    </div>
                                    @error('annual_operating_cost')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Year</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="year">
                                    </div>
                                    @error('year')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Replacement Value</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="replacement_value">
                                    </div>
                                    @error('replacement_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Inventoried By</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            placeholder="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="title">
                                    </div>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Trade in Value</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="trade_in_value">
                                    </div>
                                    @error('trade_in_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Body</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="body">
                                    </div>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Present Value</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1"
                                            name="present_value">
                                    </div>
                                    @error('present_value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Comments</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="comments"></textarea>
                                    </div>
                                    @error('comments')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-20">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Notes</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="notes"></textarea>
                                </div>
                                @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br>
                            <br>
                            <br>


                            {{-- //page 2  --}}

                            {{-- <div class="row">
                                        <div class="col-sm">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label" >Transaction Number</label>
                                              <input type="text" class="form-control" id="exampleFormControlInput1" >
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Purchase Date</label>
                                              <input type="text" class="form-control" id="exampleFormControlInput1" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Type</label>
                                                <input type="text" class="form-control" id="exampleFormControlInput1" >
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Classification</label>
                                                <input type="text" class="form-control" id="exampleFormControlInput1" >
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                                                <input type="text" class="form-control" id="exampleFormControlInput1" >
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Replacement Value</label>
                                                <input type="text" class="form-control" id="exampleFormControlInput1" >
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Trade in Value</label>
                                                <input type="text" class="form-control" id="exampleFormControlInput1" >
                                              </div>
                                              <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Present Value</label>
                                                <input type="text" class="form-control" id="exampleFormControlInput1" >
                                              </div>
                                        </div>
                                        <div class="col-sm">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Purchase Price</label>
                                              <input type="text" class="form-control" id="exampleFormControlInput1" >
                                            </div>
                                        </div>
                                      </div>
                    
                    
                                      <br>
                                      <br>
                                      <br>
                      
                      
                                      {{-- //page 3  --}}
                            {{-- <div class="row">
                                        <div class="col-sm">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Inventory Number</label>
                                              <input type="text" class="form-control" id="exampleFormControlInput1" >
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                          <div class="mb-3">
                                              <label for="exampleFormControlInput1" class="form-label">Classifications</label>
                                              <input type="text" class="form-control" id="exampleFormControlInput1" >
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
                                              <input type="text" class="form-control" id="exampleFormControlInput1" >
                                            </div>
                                        </div>
                                      </div>  --}}

                            {{-- <div class="container col-md-6">
                                        <div class="mb-3">
                                            <label for="Image" class="form-label">Upload File</label>
                                            <input class="form-control" type="file" id="formFile" onchange="preview()">
                                        </div>
                                    </div> --}}
                            <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
