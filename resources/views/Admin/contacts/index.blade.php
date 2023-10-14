@extends('Admin.layout.index')
@section('title')
    Contacts
@endsection
@section('content')
    <div class="card-body">
        <table id="contacts" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
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
            myTable = $('#contacts').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('contactsDashboard.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'message', name: 'message'},
                    {data: 'subject', name: 'subject'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'actions', name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
        $('#contacts').on('click','#btnDelete',function() {
            var contactId = $(this).data('id');
            var url = "{{route('contactsDashboard.destroy',':contactId')}}"
            url = url.replace(':contactId',contactId);
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
