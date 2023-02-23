<table>
    <tr>
        <th>
            Items Report
        </th>
    </tr>

    <tr>
        <th>
            Date: {{ date('M. d, Y') }}
        </th>
    </tr>

    <tr>
        <th>
            Reported by: {{ Auth::user()->name }}
        </th>
    </tr>

    <tr></tr>

    <thead>
        <tr>
            <th>No.</th>
            <th>Inventory Number</th>
            <th>Asset</th>
            <th>Classification</th>
            <th>Serial Number</th>
            <th>Condition</th>
            <th>Color</th>
            <th>Warranty</th>
            <th>Price</th>
            <th>Supplier</th>
            <th>Contact Number</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->serial_id }}</td>
                <td>{{ $item->inventory_number }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->classification }}</td>
                <td>{{ $item->serial_no }}</td>
                <td>{{ $item->condition }}</td>
                <td>{{ $item->color }}</td>
                <td>{{ $item->warranty }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->supplier }}</td>
                <td>{{ $item->contact_no }}</td>
                <td>{{ $item->serial_date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
