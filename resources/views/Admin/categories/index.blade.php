@extends('Admin.layout.index')
@section('title')
    Categories
@endsection
@section('content')
    <a id="addType" class="btn btn-primary" role="button">Add New Category</a>
    <div class="card-body">

        <table id="categories" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Store Name</th>
                <th>Category Image</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Store Name</th>
                <th>Category Image</th>
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
            myTable = $('#categories').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'store_id', name: 'store_id'},
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
                url: "{{ route('categories.create')}}",
                success: function (response) {
                    $('.modal-body').html(response.createForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Add New Category');
                }
            });
        });

        $('#categories').on('click','#btnEdit',function() {
            var categoryId = $(this).data('id');
            var url = "{{route('categories.edit',':categoryId')}}"
            url = url.replace(':categoryId',categoryId);
            $.ajax({
                url: url,
                success: function (response) {
                    $('.modal-body').html(response.editForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Edit Category');
                }
            });
        });

        $('#categories').on('click','#btnDelete',function() {
            var categoryId = $(this).data('id');
            var url = "{{route('categories.destroy',':categoryId')}}"
            url = url.replace(':categoryId',categoryId);
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
