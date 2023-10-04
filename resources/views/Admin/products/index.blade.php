@extends('Admin.layout.index')
@section('title')
    Products
@endsection
@section('content')
    <a id="addType" class="btn btn-primary" role="button">Add New Product</a>
    <div class="card-body">

        <table id="products" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Discount%</th>
                <th>Category</th>
                <th>Store</th>
                <th>Added By</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Discount%</th>
                <th>Category</th>
                <th>Store</th>
                <th>Added By</th>
                <th>Actions</th>
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
            myTable = $('#products').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'image', name: 'image'},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'price', name: 'price'},
                    {data: 'discount', name: 'discount'},
                    {data: 'category_id', name: 'category_id'},
                    {data: 'story_id', name: 'story_id'},
                    {data: 'user_id', name: 'user_id'},
                    {
                        data: 'actions', name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        $("#addType").on('click', function () {
            $.ajax({
                url: "{{ route('products.create')}}",
                success: function (response) {
                    $('.modal-body').html(response.createForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Add New Product');
                }
            });
        });

        $('#coupons').on('click','#btnEdit',function() {
            var couponId = $(this).data('id');
            var url = "{{route('coupons.edit',':couponId')}}"
            url = url.replace(':couponId',couponId);
            $.ajax({
                url: url,
                success: function (response) {
                    $('.modal-body').html(response.editForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Edit Coupon');
                }
            });
        });
        $('#coupons').on('click','#btnStatus',function() {
            var couponId = $(this).data('id');
            var url = "{{route('coupons.show',':couponId')}}"
            url = url.replace(':couponId',couponId);
            $.ajax({
                url: url,
                success: function (response) {
                    toastr.success(response.success);
                    myTable.ajax.reload();
                }
            });
        });

        $('#coupons').on('click','#btnDelete',function() {
            var couponId = $(this).data('id');
            var url = "{{route('coupons.destroy',':couponId')}}"
            url = url.replace(':couponId',couponId);
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token
                },
                success: function (response) {
                    toastr.success(response.success);
                    myTable.ajax.reload();
                }
            });
        });
    </script>
    <script>

    </script>
    <script>

        // Initiate form validation
        $.validate({
            modules: 'date, security'
        });
    </script>
@endsection
