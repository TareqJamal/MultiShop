@extends('Admin.layout.index')
@section('title')
    Stores
@endsection
@section('content')
    <a id="addType" class="btn btn-primary" role="button">Add New Store</a>
    <div class="card-body">

        <table id="stores" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Store Name</th>
                <th>Store Capacity</th>
                <th>Store Type</th>
                <th>Store Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Store Name</th>
                <th>Store Capacity</th>
                <th>Store Type</th>
                <th>Store Image</th>
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
            myTable = $('#stores').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('stores.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'storageCapacity', name: 'storageCapacity'},
                    {data: 'stores_types_id', name: 'stores_types_id'},
                    {data: 'image', name: 'image'},
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
                url: "{{ route('stores.create')}}",
                success: function (response) {
                    $('.modal-body').html(response.createForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Add New Store');
                }
            });
        });

        $('#stores').on('click','#btnEdit',function() {
            var storeId = $(this).data('id');
            var url = "{{route('stores.edit',':storeId')}}"
            url = url.replace(':storeId',storeId);
            $.ajax({
                url: url,
                success: function (response) {
                    $('.modal-body').html(response.editForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Edit Store');
                }
            });
        });

        $('#stores').on('click','#btnDelete',function() {
            var storeId = $(this).data('id');
            var url = "{{route('stores.destroy',':storeId')}}"
            url = url.replace(':storeId',storeId);
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
