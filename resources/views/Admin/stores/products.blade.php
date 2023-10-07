@extends('Admin.layout.index')
@section('title')
    Product of Stores
@endsection
@section('content')
    <table id="products" class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price $</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @php($count = 1 )
        @foreach($products as $product)
        <tr>
            <td>{{$count++}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td><img src="{{asset('')}}{{$product->image}}" width="100px" height="100px"></td>
            <td>{{$product->price}}</td>
            <td>
                <button  class="btn btn-success btnView" data-id="{{$product->id}}"><i class="fa fa-eye"></i> View</button>
            </td>

        </tr>
        @endforeach

        </tbody>
    </table>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    $('.btnView').on('click',function() {

        var productId = $(this).data('id');
        var url = "{{route('products.show',':productId')}}"
        url = url.replace(':productId',productId);
        $.ajax({
            url: url,
            type: 'Get',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token
            },
            success: function (response) {
                $('.modal-body').html(response.html);
                $('#Modal').modal('show');
                $('#ModalLabel').text('Details of Product');
            }
        });
    });
    });
</script>
