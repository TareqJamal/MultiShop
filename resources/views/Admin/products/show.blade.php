
<table class="table">
    <tbody>
    <tr>
        <th scope="row">Name</th>
        <td>{{ $product->name }}</td>
    </tr>
    <tr>
        <th scope="row">Description</th>
        <td>{{ $product->description }}</td>
    </tr>
    <tr>
        <th scope="row">Image</th>
        <td>
            <img src="{{asset('')}}{{$product->image}}" width="150px" height="150px">
        </td>
    </tr>
    <tr>
        <th scope="row">Category</th>
        <td>{{ $product->cateories->name }}</td>
    </tr>
    <tr>
        <th scope="row">Price</th>
        <td>{{ $product->price }} $</td>
    </tr>
    <tr>
        <th scope="row">Discount</th>
        <td>{{ $product->discount }} %</td>
    </tr>
    <tr>
        <th scope="row">Quantity</th>
        <td>{{ $product->quantity }}</td>
    </tr>
    <tr>
        <th scope="row">Store</th>
        <td>{{ $product->stores->name }}</td>
    </tr>
    <tr>
        <th scope="row">Added By</th>
        <td>{{ $product->admins->name }}</td>
    </tr>
    <tr>
        <th scope="row">Created At</th>
        <td>{{ $product->created_at->format("Y-m-d") }}</td>
    </tr>
    </tbody>
</table>


