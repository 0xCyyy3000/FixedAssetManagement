
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
                    <div class="center">
                        <h1 class="h1">Return Request</h1>
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
                                    <th scope="col">Serial No.</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Cost</th>
                                </tr>
                            </thead>
                            
                            <tbody id="return-items-table-body">
                                @foreach ($serials as $serial)
                                    <tr>
                                        <td>{{ $serial->title }}</td>
                                        <td>{{ $serial->serial_no }}</td>
                                        <td>{{ $serial->remarks }}</td>
                                        <td><span>&#8369;</span> {{ $serial->cost }}</td>
                                       
                                        
                                    </tr>
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                  <td>Total</td>
                                  <td> <span>&#8369;</span> {{ $request->amount }}</td>
                                </tr>
                              </tfoot>
                        </table>
                  

