<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
       table, th, td {
        border: 1px solid white;
        border-collapse: collapse;
        
        }
        th, td {
        background-color: #96D4D4;
       
        }
        td{
            text-align:center;
            width:20px;
            height:20px;
        }
        table{
            margin-left: auto;
            margin-right: auto;
        }
        </style>
</head>
<body>
    <hr>
    <h1>Asset Inventory</h1>
    <table >
        <thead >
            <th scope="col"> </th>
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
