@extends('Admin.layout.index')
@section('title')
    Admins
@endsection
@section('content')
    <a id="addAdmin" class="btn btn-primary" role="button">Add New Admin</a>
    <div class="card-body">

        <table id="admins" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Is Verified</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Image</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Is Verified</th>
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
            myTable = $('#admins').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admins.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'image', name: 'image'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'is_verified', name: 'is_verified'},
                    {
                        data: 'actions', name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        $("#addAdmin").on('click', function () {
            $.ajax({
                url: "{{ route('admins.create')}}",
                success: function (response) {
                    $('.modal-body').html(response.createForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Add New Admin');
                }
            });
        });

        $('#admins').on('click','#btnEdit',function() {
            var adminId = $(this).data('id');
            var url = "{{route('admins.edit',':adminId')}}"
            url = url.replace(':adminId',adminId);
            $.ajax({
                url: url,
                success: function (response) {
                    $('.modal-body').html(response.editForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Edit Admin');
                }
            });
        });

        $('#admins').on('click','#btnDelete',function() {
            var adminId = $(this).data('id');
            var url = "{{route('admins.show','adminId')}}"
            url = url.replace('adminId',adminId);
            $.ajax({
                url: url,
                success: function (response) {
                    toastr.success('Admin Deleted Successfully')
                    myTable.ajax.reload();
                }
            });
        });
    </script>
    <script>

    </script>

@endsection
