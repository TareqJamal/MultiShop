@extends('Admin.layout.index')
@section('title')
    Carts
@endsection
@section('content')
    <div class="card-body">
        <table id="reviews" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Product Color</th>
                <th>Product Size</th>
                <th>Product Price</th>
                <th>Total Price</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Product Color</th>
                <th>Product Size</th>
                <th>Product Price</th>
                <th>Total Price</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
@section('js')
    <script>
        var myTable;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(function () {
            myTable = $('#reviews').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('carts.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'customer_id', name: 'customer_id'},
                    {data: 'email', name: 'email'},
                    {data: 'productName', name: 'productName'},
                    {data: 'productImage', name: 'productImage'},
                    {data: 'productColor', name: 'productColor'},
                    {data: 'productSize', name: 'productSize'},
                    {data: 'productPrice', name: 'productPrice'},
                    {data: 'total', name: 'total'},
                ]
            });
        });
    </script>
    <script>

        // Initiate form validation
        $.validate({
            modules: 'date, security'
        });
    </script>
@endsection
