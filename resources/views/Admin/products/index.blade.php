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
                <th>Price $</th>
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
                <th>Price $</th>
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
                    {data: 'price', name: 'price'},
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

        $('#products').on('click','#btnEdit',function() {
            var productId = $(this).data('id');
            var url = "{{route('products.edit',':productId')}}"
            url = url.replace(':productId',productId);
            $.ajax({
                url: url,
                success: function (response) {
                    $('.modal-body').html(response.editForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Edit Product');
                }
            });
        });

        $('#products').on('click','#btnDelete',function() {
            var productId = $(this).data('id');
            var url = "{{route('products.destroy',':productId')}}"
            url = url.replace(':productId',productId);
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
        $('#products').on('click','#btnView',function() {
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
        $('#products').on('click','#btnAttributes',function() {
            var productId = $(this).data('id');
            var url = "{{route('attributes.show',':productId')}}"
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
                    $('#ModalLabel').text('Attributes of Product');
                }
            });
        });
        $('#products').on('click','#btnImages',function() {
            var productId = $(this).data('id');
            var url = "{{route('images.show',':productId')}}"
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
                    $('#ModalLabel').text('Images of Product');
                }
            });
        });

    </script>
@endsection
