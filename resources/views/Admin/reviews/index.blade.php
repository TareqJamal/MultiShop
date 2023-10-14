@extends('Admin.layout.index')
@section('title')
    Reviews
@endsection
@section('content')
    <div class="card-body">
        <table id="reviews" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Review</th>
                <th>Product</th>
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
                <th>Review</th>
                <th>Product</th>
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
            myTable = $('#reviews').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('reviewsDashboard.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'message', name: 'message'},
                    {data: 'product_id', name: 'product_id'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'actions', name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
        $('#reviews').on('click','#btnDelete',function() {
            var reviewId = $(this).data('id');
            var url = "{{route('reviewsDashboard.destroy',':reviewId')}}"
            url = url.replace(':reviewId',reviewId);
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
