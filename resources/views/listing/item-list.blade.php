@extends('layouts.app')
@section('content')
<head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<div class="container">
    
    <div class="row justify-content-center">
        
        <div class="">
            
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Date Purchased</th>
                            <th scope="col">Inventory no.</th>
                            <th scope="col">Serial Number</th>
                            <th scope="col">Item</th>
                            <th scope="col">Classification</th>
                            <th scope="col">Type</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item) 
                          <tr>
                            <td>{{ $item->purchase_date}}</td>
                            <td>{{ $item->inventory_number}}</td>
                            <td>{{ $item->serial_number}}</td>
                            <td>{{ $item->title}}</td>
                            <td>{{ $item->classification}}</td>
                            <td>{{ $item->type}}</td>
                            <td>{{ $item->quantity}}</td>
                            <td>
                              <button type="button" class="btn btn-sm " data-toggle="modal" data-target="#exampleModal">Edit</button>
                            </td>
                          </tr>
                        </tbody>
                        @endforeach
                      </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content  ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-xl">

        <form method="POST" action="/ItemListEdit">
          @method('PUT')
          @csrf
          <div class="card-body">
          <div class="row">
              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Transaction Number</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="transaction_number">
                  </div>
              </div>
              <div class="col-sm">
                  <div class="mb-3 ">
                      <label for="exampleFormControlInput1" class="form-label">Purchase Date</label>
                      <input type="text" class="form-control" id="datepicker"
                          name="purchase_date">
                  </div>
              </div>
              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Purchase Price</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="purchase_price">
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Inventory Number</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="inventory_number">
                  </div>
              </div>
              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Type</label>
                      <select id="type" name="type" class="form-control" >
                          <option value="Machine">Machine</option>
                          <option value="plant">plant</option>
                          <option value="Tangible">Tangible</option>
                        </select>
                  </div>
              </div>
              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label"> Salvage Value</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="salvage_value">
                  </div>
              </div>
          </div>


          <div class="row">
              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Serial Number</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="serial_number">
                  </div>
              </div>

              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Classification</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="classification">
                  </div>
              </div>

              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Lifespan</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="lifespan">
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Department</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="department">
                  </div>
              </div>

              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Quantity</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="quantity">
                  </div>
              </div>

              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Annual Operating
                          Cost</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="annual_operating_cost">
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Year</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="year">
                  </div>
              </div>

              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Replacement Value</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="replacement_value">
                  </div>
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
              </div>

              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Trade in Value</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="trade_in_value">
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Body</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="body">
                  </div>
              </div>
              
              <div class="col-sm">
                  <div class="mb-3">
                      <label for="exampleFormControlInput1" class="form-label">Present Value</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1"
                          name="present_value">
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-10">
                  <div class="form-group">
                      <label for="exampleFormControlTextarea1">Comments</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="comments"></textarea>
                  </div>
              </div>
          </div>

          <div class="col-20">
              <div class="form-group">
                  <label for="exampleFormControlTextarea1">Notes</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="notes"></textarea>
              </div>
          </div>
                  <script>
                    $(function () {
                          $("#datepicker").datepicker({ 
                                  autoclose: true, 
                                  todayHighlight: true
                          }).datepicker('update', new Date());
                          });
                    </script>
                   

      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Edit Modal -->


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@endsection
