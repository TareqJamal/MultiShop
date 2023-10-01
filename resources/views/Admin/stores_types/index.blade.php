@extends('Admin.layout.index')
@section('title')
    Stores Types
@endsection
@section('content')
    <a id="addType" class="btn btn-primary" role="button">Add New Type</a>
    <div class="card-body">

        <table id="storesTypes" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
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
            myTable = $('#storesTypes').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('stores-types.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'type', name: 'type'},
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
                url: "{{ route('stores-types.create')}}",
                success: function (response) {
                    $('.modal-body').html(response.createForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Add New Type');
                }
            });
        });

        $('#storesTypes').on('click','#btnEdit',function() {
            var storeTypeId = $(this).data('id');
            var url = "{{route('stores-types.edit',':storeTypeId')}}"
            url = url.replace(':storeTypeId',storeTypeId);
            $.ajax({
                url: url,
                success: function (response) {
                    $('.modal-body').html(response.editForm);
                    $('#Modal').modal('show');
                    $('#ModalLabel').text('Edit Type');
                }
            });
        });

        $('#storesTypes').on('click','#btnDelete',function() {
            var storeTypeId = $(this).data('id');
            var url = "{{route('stores-types.destroy',':storeTypeId')}}"
            url = url.replace(':storeTypeId',storeTypeId);
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
