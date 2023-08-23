<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Product Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->type->product->product_name }}</td>
                <td>{{ $item->type->type_name }}</td>
                <td>{{ $item->type->price }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
