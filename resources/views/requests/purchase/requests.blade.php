
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        table, th, td {
         border-collapse: collapse;
         border: 1px solid black;
         
         
         }
        .h1{
            margin-bottom: 0;
         }
         p{
            margin-top: 0;
         }
         td{
             text-align:center;
             width:120px;
             height:50px;
         }
         table{
             margin-left: auto;
             margin-right: auto;
         }
         .center{
            text-align: center;
           
            
         }
         .column {
            padding-bottom: 2%;
            margin-right: 5%;
            display: inline-block;
             
            }
            .column2 {
           padding-right: 10%;
             
            }
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        .total{
            padding-bottom: 2%;
            margin-left: 24%;
            display: inline-block;
        }
         </style>
</head>
<body>
    
</body>
</html>      
                {{-- <div class="row p-3">
                    <div class="center">
                        <h3 >Return Request Form</h3>
                        <p class="text-align:center;">{{ $request->transaction_no }}</p>
                    </div>
                    <div class="">
                        <div class="">
                            <label for="return_date" class="text-align:center;">Submitted on</label>
                            <p class="text-align:center;"> {{ $request->created_at }}</p>
                        </div>
                        <div class="">
                            <label for="return_date" class="form-label">Requested by</label>
                            <p class="text-muted fw-bold">{{ Auth::user()->requester($request->requester)->name }}</p>
                        </div>
                        <div class="">
                            <label for="entity" class="form-label">Entity Name</label>
                            <p class="text-muted fw-bold"> {{ $request->entity }}</p>
                        </div>
                        <div class="">
                            <label for="fund_cluster" class="form-label">Fund Cluster</label>
                            <p class="text-muted fw-bold">{{ $request->fund_cluster }} </p>
                        </div>
                        <div class="">
                            <label for="section" class="form-label">Office Section</label>
                            <p class="text-muted fw-bold">{{ $request->office_section }}</p>
                        </div>
                        <div class="">
                            <label for="appendix_no" class="form-label">Appendix No.</label>
                            <p class="text-muted fw-bold"> {{ $request->appendix_no }}</p>
                        </div>
                    </div> --}}
                    <div class="center">
                        <h1 class="h1">Purchase Request</h1>
                        <p >{{ $request->transaction_no }}</p>
                        <label class="column" for="return_date" >Submitted on: {{ $request->created_at }}</label>
                        <div class="column"><label>Requested by:{{ Auth::user()->requester($request->requester)->name }}</label>
                </div>
                   <div class="center">
                    <label class="column" for="return_date" >Fund Cluster: {{ $request->fund_cluster }}</label>
                        <div class="column"><label>Office Section: {{ $request->office_section }}</label>
                   </div>
                        <table class="">
                            <thead class="">
                                <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </thead>
                            
                            <tbody id="return-items-table-body">
                                        @foreach($serials as $serial)
                                <tr>
                                    <td>{{ $serial->item }}</td>
                                    <td>{{ $serial->description }}</td>                    
                                    <td>{{ $serial->qty }}</td>
                                    <td><span>&#8369;</span> {{ $serial->price }}</td>
                                </tr>
                                        
                                    </tr>
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                  <td>Total</td>
                                  <td> <span>&#8369;</span> {{ $serial->total }}</td>
                                </tr>
                              </tfoot>
                        </table>
                  

