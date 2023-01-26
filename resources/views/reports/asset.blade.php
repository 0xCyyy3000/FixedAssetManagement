<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
       table, th, td {
        border: 2px solid rgb(0, 0, 0);
        border-collapse: collapse;
        
        }
        th, td {
       
        }
        td{
            text-align:center;
            width:20px;
            height:20px;
        }
        table{
            margin-left: auto;
            margin-right: auto;
            margin-top: 0;
        }
        .margin{
            margin-top: 0;
            margin-bottom: 0;

        }
        .margin1{
            margin-top: 0;
            margin-bottom: 0;
            text-align: center;
            margin-left: 0;
        }
        </style>
</head>
<body>
    <h1 class="margin1">Republic of the Philippines</h1>
    <h1 class="margin1"> Deptartment of interior and local governance </h1>
    <h1 class="margin1"> Bureau of Fire Protection</h1>
    <hr>
    <h1 class="margin">Fixed Asset Inventory</h1>
    <p class="margin">{{ \Carbon\Carbon::now()->format('d-m-Y')}}</p>
    <hr>
    <table >
        <thead >
            <th scope="col">No.</th>
            <th scope="col">Inventory Number</th>
            <th scope="col">Asset</th>
            <th scope="col">Model</th>
            <th scope="col">Classification</th>
            <th scope="col">Purchase Date</th>
            <th scope="col">Price</th>
      
            <th scope="col">Serial</th>
            <th scope="col">Condition</th>
            <th scope="col">Color</th>
            <th scope="col">Location</th>
            <th scope="col">Lifespan</th>
        </thead>
        <tbody >
            @foreach($data as $items)
                <tr>
                    <td >{{ $loop->iteration }}</td>
                    <td >{{ $items->inventory_number}}</td>
                    <td >{{ $items->title}}</td>
                    <td >{{ $items->description}}</td>
                    <td >{{ $items->classification}}</td>
                    <td >{{ $items->purchase_date}}</td>
                    <td >{{ $items->location}}</td>
                  
                    <td>{{ $items->serial_no}}</td>
                    <td >{{ $items->condition}}</td>
                    <td >{{ $items->color}}</td>
                    <td >{{ $items->location}}</td>
                    <td >{{ $items->lifespan}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>             
</html>
