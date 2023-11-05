<table class="table">
    <tbody>
    <tr>
        <th scope="row">Customer Name</th>
        <td>{{ $order->customers->firstName . ' ' . $order->customers->lastName   }}</td>
    </tr>
    <tr>
        <th scope="row">First Address</th>
        <td>{{ $order->addressLine_1 }}</td>
    </tr>
    <tr>
        <th scope="row">Second Order</th>
        <td>{{ $order->addressLine_2 }}</td>
    </tr>
    <tr>
        <th scope="row">Country</th>
        <td>{{ $order->country }}</td>
    </tr>
    <tr>
        <th scope="row">City</th>
        <td>{{ $order->city }} </td>
    </tr>
    <tr>
        <th scope="row">State</th>
        <td>{{ $order->state }} </td>
    </tr>
    <tr>
        <th scope="row">ZIp Code</th>
        <td>{{ $order->zipCode }} $</td>
    </tr>
    <tr>
        <th scope="row">Total Price After Discount</th>
        <td>{{ $order->totalPrice }} $</td>
    </tr>
    <tr>
        <th scope="row">Status</th>
        @if($order->status == \App\Enum\OrderTypes::Pending->value)
            <td style="color: orange ; font-weight: bold">{{\App\Enum\OrderTypes::Pending->value}}</td>
        @elseif($order->status == \App\Enum\OrderTypes::Canceled->value)
            <td style="color: red ; font-weight: bold"> {{\App\Enum\OrderTypes::Canceled->value}}</td>
        @elseif($order->status == \App\Enum\OrderTypes::Confirmed->value)
            <td style="color: green ; font-weight: bold">{{\App\Enum\OrderTypes::Confirmed->value}} </td>
        @endif
    </tr>
    <tr>
        <th scope="row">Is Paid</th>
        @if($order->is_paid == 0)
            <td style="color: red ; font-weight: bold">No</td>
        @else
            <td style="color: green ; font-weight: bold">Yes</td>
        @endif
    </tr>
    <tr>
        <th scope="row">Ordered At</th>
        <td>{{ $order->created_at->format("Y-m-d") }}</td>
    </tr>
    <tr>
        <th scope="row">Payment Method</th>
        <td>{{ $order->paymentMethod}}</td>
    </tr>
    </tbody>
</table>
<h4>Details</h4>
@php($total = 0)
<table class="table">
    <tbody>
    <tr>
        <th scope="row">Product Name</th>
        <th scope="row">Product Price</th>
        <th scope="row">Product Image</th>
        <th scope="row">Quantity</th>
        <th scope="row">Sub Total</th>
    </tr>
    @foreach($orderDetails as $product)
        <tr>
            <td>{{$product->products->name}}</td>
            <td>{{$product->products->price}}</td>
            <td><img src="{{asset('')}}{{$product->products->image}}" width="100px" height="100px"></td>
            <td>{{$product->quantity}}</td>
            <td>{{$product->quantity * $product->products->price }} $</td>
        </tr>
        @php($total += ($product->quantity * $product->products->price) )
    @endforeach
    <td></td>
    <td></td>
    <td></td>
    <td>Total: </td>
    <td> {{$total}} $</td>
    </tbody>
</table>


