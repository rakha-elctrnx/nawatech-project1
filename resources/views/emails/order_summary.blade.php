<html>
    <body>
        <h1>Summary Pesanan</h1>
        <p>Product Name: {{ $order->type->product->product_name }}</p>
        <p>Type: {{ $order->type->type_name }}</p>
        <p>Price: Rp. {{ number_format($order->type->price) }}</p>
        <p>Date: {{ $order->created_at }}</p>
    </body>
</html>