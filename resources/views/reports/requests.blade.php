<head>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            margin: auto;
            margin-left: 2%;
          }
        div p{
            margin: auto;
            width: 50%;
            padding: 10px;
          }
        </style>
</head>


               
                <div class="row p-3">
                    <div class="">
                        <h3 class="text-center fw-semibold">Return Request Form</h3>
                        <p class="">{{ $request->transaction_no }}</p>
                    </div>
                    <div class="row w-75 m-auto">
                        <div class="mb-3 col-4">
                            <label for="return_date" class="form-label">Submitted on</label>
                            <p class="text-muted fw-bold"> {{ $request->created_at }}</p>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="return_date" class="form-label">Requested by</label>
                            <p class="text-muted fw-bold">{{ Auth::user()->requester($request->requester)->name }}</p>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="entity" class="form-label">Entity Name</label>
                            <p class="text-muted fw-bold"> {{ $request->entity }}</p>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="fund_cluster" class="form-label">Fund Cluster</label>
                            <p class="text-muted fw-bold">{{ $request->fund_cluster }} </p>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="section" class="form-label">Office Section</label>
                            <p class="text-muted fw-bold">{{ $request->office_section }}</p>
                        </div>
                        <div class="mb-3 col-4">
                            <label for="appendix_no" class="form-label">Appendix No.</label>
                            <p class="text-muted fw-bold"> {{ $request->appendix_no }}</p>
                        </div>
                    </div>
                    <div class="container mt-5 mb-3">
                        <table class="table mb-3">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Serial No.</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col">Cost</th>
                                </tr>
                            </thead>
                            <tbody id="return-items-table-body">
                                @foreach ($serials as $serial)
                                    <tr>
                                        <td>{{ $serial->title }}</td>
                                        <td>{{ $serial->serial_no }}</td>
                                        <td>{{ $serial->description }}</td>
                                        <td>{{ $serial->remarks }}</td>
                                        <td>PHP {{ $serial->cost }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h4 class="text-end d-none" id="return-items-total"></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

